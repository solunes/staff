<?php 

namespace Solunes\Staff\App\Helpers;

class Staff {

    public static function generateCompany($array, $external_code) {
        if(!\Solunes\Staff\App\Company::where('external_code', $external_code)->first()){
            $item = new \Solunes\Staff\App\Company;
            foreach($array as $array_key => $array_item){
                $item->$array_key = $array_item;
            }
            $item->external_code = $external_code;
            $item->save();
            return $item;
        }
    }

    public static function generateContact($array, $external_code) {
        if($item = \Solunes\Staff\App\Contact::where('external_code', $external_code)->first()){
        } else {
            $item = new \Solunes\Staff\App\Contact;
            $item->external_code = $external_code;
        }
        foreach($array as $array_key => $array_item){
            $item->$array_key = $array_item;
        }
        $item->save();
        return $item;
    }

    public static function generateDeal($array, $external_code, $companies, $contacts) {
        $item = new \Solunes\Staff\App\Company;
        foreach($array as $array_key => $array_item){
            $item->$array_key = $array_item;
        }
        $item->external_code = $external_code;
        $item->save();
        if(count($companies)>0){
            foreach($companies as $company){

            }
        }
        if(count($contacts)>0){
            foreach($contacts as $contact){
                
            }
        }
        return $item;
    }

    public static function exportCompany($item) {
        $array = ['name','industry','domain','phone','description'];
        $properties = \Staff::generateHubspotField($item, $array);
        $fixed_item['properties'] = $properties;
        $item = \Staff::generateHubspotQuery('company', $item, $fixed_item);
        return $item;
    }

    public static function exportContact($item) {
        $array = ['firstname','lastname','email','jobtitle','phone','message'];
        $properties = \Staff::generateHubspotField($item, $array);
        $fixed_item['properties'] = $properties;
        $item = \Staff::generateHubspotQuery('contact', $item, $fixed_item);
        return $item;
    }

    public static function exportDeal($item) {
        $array = ['dealname','service','amount','dealstage','dealtype'];
        $properties = \Staff::generateHubspotField($item, $array);
        $fixed_item['properties'] = $properties;
        $item = \Staff::generateHubspotQuery('deal', $item, $fixed_item);
        return $item;
    }

    public static function importHubspotProperty($properties, $array) {
        foreach($array as $field){
            if(isset($properties->$field)){
                $value = $properties->$field;
                $object[$field] = $value->value;
            }
        }
        return $object;
    }

    public static function generateHubspotField($item, $array) {
        foreach($array as $field){
            if($value = $item->$field){
                $properties[] = ['name'=>$field, 'value'=>$value];
            }
        }
        return $properties;
    }

    public static function generateHubspotQuery($type, $item, $fixed_item) {
        $fixed_item = json_encode($fixed_item);
        if($item->external_code){
            $action = 'update';
            $response = \HubSpot::$type()->$action($item->external_code, $fixed_item);
        } else {
            $action = 'create';
            $response = \HubSpot::$type()->$action($fixed_item);
            $item->external_code = $response->portalId;
            $item->save();
        }
        return $item;
    }

}