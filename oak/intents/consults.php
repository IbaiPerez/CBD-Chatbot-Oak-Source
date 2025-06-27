<?php

    if(intent("consulta_cuenta")) {

        ob_start();

        $tab = getIntentParameter()['tablas'];

        ob_end_clean();

        if(!$tab) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["¿De que quieres saberlo?"];

            $cTitleArray = ["Pokemones", "Tipos de pokemones", "Tipos de piedras"];
            $cImageArray = ["https://art.pixilart.com/c07ac139be28eba.png","https://i.pinimg.com/736x/3c/dd/17/3cdd17306e51b9ff6c0264241e3e4c4c.jpg","https://images.wikidexcdn.net/mwuploads/wikidex/b/ba/latest/20240216054922/Piedra_trueno_Sleep.png"];
            $cCustomArray = ["pokemon","tipo","tipo_piedra"];


            $structure = [
                            'paragraph',
                            'superDivider',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else{

            if($tab == "tipo_piedra") {
                $title = "tipos de piedras";
            } else if($tab == "tipo"){
                $title = "tipos de pokemones";
            } else if($tab == "pokemon"){
                $title = "pokemones";
            }

            $n = Consultas::cuenta_simple($tab)[0]['COUNT(*)'];

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["$title"];
            $pSubtitleArray = ["Hay $n $title"];

            $structure = [
                            'paragraph'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }


    }

    if(intent("consulta_todos")) {

        ob_start();

        $tab = getIntentParameter()['tablas'];

        ob_end_clean();
        
        if(!$tab){

            
            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["¿De que quieres saberlo?"];

            $cTitleArray = ["Pokemones", "Tipos de pokemones", "Tipos de piedras"];
            $cImageArray = ["https://art.pixilart.com/c07ac139be28eba.png","https://i.pinimg.com/736x/3c/dd/17/3cdd17306e51b9ff6c0264241e3e4c4c.jpg","https://images.wikidexcdn.net/mwuploads/wikidex/b/ba/latest/20240216054922/Piedra_trueno_Sleep.png"];
            $cCustomArray = ["pokemon","tipo","tipo_piedra"];


            $structure = [
                            'paragraph',
                            'superDivider',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            if($tab == "tipo_piedra") {
                $x = "nombre_piedra";
            } else {
                $x = "nombre";
            }

            if($tab == "tipo_piedra") {
                $title = "tipos de piedras";
            } elseif($tab == "tipo"){
                $title = "tipos de pokemones";
            } elseif($tab == "pokemon"){
                $title = "Pokemones";
            }

            $p = Consultas::selecciona_simple($tab);

            
            
            $aTextArray = [[]];

            for($i = 0; $i<count($p); $i++){
                array_push($aTextArray[0], $p[$i][$x]);
            }

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];


            
            $aTitleArray = ["Estos son todos los $title"];

            $structure = [
                            'description'
                        ];

            $components = [
                            [$aTitleArray,$aTextArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);
        }


    }


    if(intent("consulta_cuentaPorTipo")) {

        ob_start();

        $type = getIntentParameter()['Tipos'];

        ob_end_clean();

        if(!$type) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["¿De que tipo quieres saberlo?"];

            $cTitleArray = [];
            $cImageArray = [];
            $cCustomArray = [];

            $tipos = Consultas::get_tipos();

            for($i=0; $i< count($tipos); $i++) {
                array_push($cTitleArray, $tipos[$i]["nombre"]);
                array_push($cCustomArray, $tipos[$i]["nombre"]);
                array_push($cImageArray, $img_Zoom);
            }


            $structure = [
                            'paragraph',
                            'superDivider',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            $n = Consultas::cuentaPokemon_tipo($type)[0]['cantidad'];

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["$type"];
            $pSubtitleArray = ["Hay $n  pokemones de tipo $type"];

            $cTitleArray = ["Cuales son los pokemones de tipo $type"];
            $cImageArray = [$img_Scroll];
            $cCustomArray = ["Cuales son los pokemones de tipo $type"];

            $structure = [
                            'paragraph',
                            'comma',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_cuentaPorPeso")) {

        ob_start();

        $peso = getIntentParameter()['unit-weight'];

        $value = getIntentParameter()["number"];

        $unit = getIntentparameter()["unit-weight-name"];

        ob_end_clean();

        if(!$peso && !$value && !$unit) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["Necesito que especifique al menos el valor del peso"];


            $structure = [
                            'paragraph',
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            ob_start();

            $comparator = getIntentParameter()["compare"];
            
            ob_end_clean();

            if($peso) {

                $value = $peso["amount"];

                $unit = $peso["unit"];

            } elseif($value) {
                
                $unit = "kg";

            } else {

                $value = 1;

            }

            
            if($unit == "g") {
                $number = $value/1000;
            } else {
                $number = $value;
            }

            if(!$comparator) {
                
                $comparator = "igual";

            }


            $n = Consultas::cuentaPokemon_peso($number,$comparator)[0]['cantidad'];

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["$value $unit"];
            $pSubtitleArray = ["Hay $n pokemones con un peso $comparator a $value $unit"];

            $cTitleArray = ["Cuales son los pokemones con un peso $comparator a $value $unit"];
            $cImageArray = [$img_Scroll];
            $cCustomArray = ["Cuales son los pokemones con un peso $comparator a $value $unit"];

            $structure = [
                            'paragraph',
                            'comma',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            

            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_cuentaPorAltura")) {

        ob_start();

        $altura = getIntentParameter()['unit-weight'];

        $value = getIntentParameter()["number"];

        $unit = getIntentparameter()["unit-length-name"];

        ob_end_clean();

        if(!$altura && !$value && !$unit) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["Necesito que especifique al menos el valor de la altura"];


            $structure = [
                            'paragraph',
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            ob_start();

            $comparator = getIntentParameter()["compare"];
            
            ob_end_clean();

            if($altura) {

                $value = $altura["amount"];

                $unit = $peso["unit"];

            } elseif($value) {
                
                $unit = "m";

            } else {

                $value = 1;

            }

            
            if($unit == "mm") {
                $number = $value/1000;
            } elseif($unit == "cm") {
                $number = $value/100;
            } elseif($unit == "dm") {
                $number = $value/10;
            } elseif($unit == "m") {
                $number = $value;
            } elseif($unit == "dam") {
                $number = $value*10;
            } elseif($unit == "hm") {
                $number = $value*100;
            } elseif($unit == "km") {
                $number = $value*1000;
            }

            if(!$comparator) {
                
                $comparator = "igual";

            }


            $n = Consultas::cuentaPokemon_altura($number,$comparator)[0]['cantidad'];

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["$value $unit"];
            $pSubtitleArray = ["Hay $n pokemones con una altura $comparator a $value $unit"];

            $structure = [
                            'paragraph'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            

            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_todosPorTipo")) {

        ob_start();

        $type = getIntentParameter()['Tipos'];

        ob_end_clean();

        if(!$type) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["¿De que tipo quieres saberlo?"];

            $cTitleArray = [];
            $cImageArray = [];
            $cCustomArray = [];

            $tipos = Consultas::get_tipos();

            for($i=0; $i< count($tipos); $i++) {
                array_push($cTitleArray, $tipos[$i]["nombre"]);
                array_push($cCustomArray, $tipos[$i]["nombre"]);
                array_push($cImageArray, $img_Zoom);
            }


            $structure = [
                            'paragraph',
                            'superDivider',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray,$cImageArray,$cCustomArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            $p = Consultas::seleccionaPokemon_tipo($type);

            
            
            $aTextArray = [[]];

            for($i = 0; $i<count($p); $i++){
                array_push($aTextArray[0], $p[$i]["nombre"]);
            }

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];


            
            $aTitleArray = ["Estos son todos los pokemones de tipo $type"];

            $structure = [
                            'description'
                        ];

            $components = [
                            [$aTitleArray,$aTextArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_todosPorPeso")) {

        ob_start();

        $peso = getIntentParameter()['unit-weight'];

        $value = getIntentParameter()["number"];

        $unit = getIntentparameter()["unit-weight-name"];

        ob_end_clean();

        if(!$peso && !$value && !$unit) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["Necesito que especifique al menos el valor del peso"];


            $structure = [
                            'paragraph',
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            ob_start();

            $comparator = getIntentParameter()["compare"];
            
            ob_end_clean();

            if($peso) {

                $value = $peso["amount"];

                $unit = $peso["unit"];

            } elseif($value) {
                
                $unit = "kg";

            } else {

                $value = 1;

            }

            
            if($unit == "g") {
                $number = $value/1000;
            } else {
                $number = $value;
            }

            if(!$comparator) {
                
                $comparator = "igual";

            }


            $p = Consultas::seleccionaPokemon_peso($number,$comparator);

            $aTextArray = [[]];

            for($i = 0; $i<count($p); $i++){
                array_push($aTextArray[0], $p[$i]["nombre"]);
            }

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];
            
            $aTitleArray = ["Estos son los pokemones con un peso $comparator a $value $unit"];

            $structure = [
                            'description'
                        ];

            $components = [
                            [$aTitleArray,$aTextArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }
?>