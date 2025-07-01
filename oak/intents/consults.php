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
            $cImageArray = [$img_Pokemon,$img_Tipo,$img_Piedra];
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

            $cTitleArray = ["Cuales son los $tab?"];
            $cImageArray = [$img_Question];
            $cCustomArray = ["Cuales son los $tab"];

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
            $cImageArray = [$img_Pokemon,$img_Tipo,$img_Piedra];
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

            

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            
            
            if($tab == "pokemon") {

                $pTitleArray = ["Estos son todos los $title"];
                $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

                $cTitleArray = [];
                $cImageArray = [];
                $cCustomArray = [];

                for($i = 0; $i<count($p); $i++){
                    array_push($cTitleArray, $p[$i][$x]);
                    array_push($cCustomArray, $p[$i][$x]);
                    array_push($cImageArray, $img_Pokeball);
                }

                $structure = [
                                'paragraph',
                                'comma',
                                'reply'
                            ];

                 $components = [
                                [$pTitleArray,$pSubtitleArray],
                                [],
                                [$cTitleArray, $cImageArray, $cCustomArray]
                            ];



            } else {

                $aTextArray = [[]];

                for($i = 0; $i<count($p); $i++){
                    array_push($aTextArray[0], $p[$i][$x]);
                }


                
                $aTitleArray = ["Estos son todos los $title"];

                $structure = [
                                'description'
                            ];

                $components = [
                                [$aTitleArray,$aTextArray]
                            ];

            }

                        
            
                        
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
            $cImageArray = [$img_Question];
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
            $cImageArray = [$img_Question];
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

        $altura = getIntentParameter()['unit-length'];

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

                $unit = $altura["unit"];

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

            $cTitleArray = ["Cuales son los pokemones con una altura $comparator a $value $unit"];
            $cImageArray = [$img_Question];
            $cCustomArray = ["Cuales son los pokemones con una altura $comparator a $value $unit"];

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

            
            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["Estos son todos los pokemones de tipo $type"];
            $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

            $cTitleArray = [];
            $cImageArray = [];
            $cCustomArray = [];

            for($i = 0; $i<count($p); $i++){
                array_push($cTitleArray, $p[$i]["nombre"]);
                array_push($cCustomArray, $p[$i]["nombre"]);
                array_push($cImageArray, $img_Pokeball);
            }

            $structure = [
                            'paragraph',
                            'comma',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray, $cImageArray, $cCustomArray]
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


            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["Estos son los pokemones con un peso $comparator a $value $unit"];
            $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

            $cTitleArray = [];
            $cImageArray = [];
            $cCustomArray = [];

            for($i = 0; $i<count($p); $i++){
                array_push($cTitleArray, $p[$i]["nombre"]);
                array_push($cCustomArray, $p[$i]["nombre"]);
                array_push($cImageArray, $img_Pokeball);
            }

            $structure = [
                            'paragraph',
                            'comma',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray, $cImageArray, $cCustomArray]
                        ];
                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_todosPorAltura")) {

        ob_start();

        $altura = getIntentParameter()['unit-length'];

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

                $unit = $altura["unit"];

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


            $p = Consultas::seleccionaPokemon_altura($number,$comparator);


            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $pTitleArray = ["Estos son los pokemones con una altura $comparator a $value $unit"];
            $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

            $cTitleArray = [];
            $cImageArray = [];
            $cCustomArray = [];

            for($i = 0; $i<count($p); $i++){
                array_push($cTitleArray, $p[$i]["nombre"]);
                array_push($cCustomArray, $p[$i]["nombre"]);
                array_push($cImageArray, $img_Pokeball);
            }

            $structure = [
                            'paragraph',
                            'comma',
                            'reply'
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray],
                            [],
                            [$cTitleArray, $cImageArray, $cCustomArray]
                        ];
                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        }

    }

    if(intent("consulta_datosPorPokemon")) {

        ob_start();

        $pokemon = getIntentparameter()["pokemon"];

        ob_end_clean();

        if(!$pokemon) {

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            $title = getInput()["queryResult"]["queryText"];

            $pTitleArray = [$title];
            $pSubtitleArray = ["De que pokemon quieres saberlo?"];


            $structure = [
                            'paragraph',
                        ];

            $components = [
                            [$pTitleArray,$pSubtitleArray]
                        ];

                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

        } else {

            ob_start();

            $p = Consultas::seleccionaPokemon_datos($pokemon)[0];

            ob_end_clean();

            if(!$p) {

                triggerError(false,[], ['consulta_datosPorPokemon'],['Este pokemon no existe'],[]);

            }

            $nombre = $p["nombre"];
            $peso = $p["peso"];
            $altura = $p["altura"];
            $tipo = $p["tipo"];

            ob_start();

            if(!$p["evoluciona_a"]) {

                $evolucion = "No tiene evolución";

            } elseif($p["nivel_evolucion"]) {

                $evoluciona_a = $p['evoluciona_a'];
                $nivel = $p['nivel_evolucion'];

                $evolucion = "Evoluciona a $evoluciona_a al nivel $nivel";

            } elseif($p['piedra_evolucion']) {

                $evoluciona_a = $p['evoluciona_a'];
                $piedra = $p['piedra_evolucion'];

                $evolucion = "Evoluciona a $evoluciona_a utilizando una $piedra";

            } else {

                $evoluciona_a = $p['evoluciona_a'];


                $evolucion = "Evoluciona a $evoluciona_a por intercambio";

            }


            ob_end_clean();

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            


            $dTitleArray = [$nombre];
            $dTextArray = [["Peso: $peso kg","Altura: $altura m", "Tipo: $tipo", $evolucion]];

            $structure = [
                            'description'
                        ];

            $components = [
                            [$dTitleArray,$dTextArray]
                        ];

                        
            
                        
            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);


        }


    }

    if(intent('consulta_cuentaPorEvolucion')) {
        
            ob_start();

            $a = getIntentParameter()["atributoevolucion"];

            ob_end_clean();

            
            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            if(!$a) {

                ob_start();

                $n = getIntentParameter()["number"];

                $p = getIntentParameter()["piedra"];

                ob_end_clean();

                if($p) {

                    $c = Consultas::cuentaPokemon_evolucionPiedra($p)[0]["cantidad_pokemones"];

                    $pTitleArray = ["Cantidad de pokemones que evolucionan con una $p"];
                    $pSubtitleArray = ["Hay $c pokemones que evolucionan con una $p"];

                    $cTitleArray = ["Cuales son los pokemones que evolucionan con una $p"];
                    $cImageArray = [$img_Question];
                    $cCustomArray = ["Cuales son los pokemones que evolucionan con una $p"];

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

                } elseif($n) {


                    ob_start();

                    $comparator = getIntentParameter()["compare"];
            
                    ob_end_clean();

                    if(!$comparator) {

                        $comparator = "igual";

                    }

                    $c = Consultas::cuentaPokemon_evolucionNivel($n,$comparator)[0]["cantidad_pokemones"];

                    $pTitleArray = ["Cantidad de pokemones que evolucionan a un nivel $comparator que el $n"];
                    $pSubtitleArray = ["Hay $c pokemones que evolucionan a un nivel $comparator que el $n"];

                    $cTitleArray = ["Cuales son los pokemones que evolucionan a un nivel $comparator que el $n"];
                    $cImageArray = [$img_Question];
                    $cCustomArray = ["Cuales son los pokemones que evolucionan a un nivel $comparator que el $n"];

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

                } else {

                    $ce = Consultas::cuentaPokemon_evolucion();

                    $c = 0;

                    for($i = 0; $i<count($ce); $i++) {

                        $c += $ce[$i]["cantidad_pokemon"];

                    }


                    $pTitleArray = ["Cantidad de pokemones que evolucionan"];
                    $pSubtitleArray = ["Hay $c pokemones que evolucionan"];

                    $cTitleArray = ["Cuales son los pokemones que evolucionan"];
                    $cImageArray = [$img_Question];
                    $cCustomArray = ["Cuales son los pokemones que evolucionan"];

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

                }

            } else {

                $ce = Consultas::cuentaPokemon_evolucion();

                for($i = 0; $i<count($ce); $i++) {

                    if($ce[$i]["metodo"]==$a) {
                        $c = $ce[$i]["cantidad_pokemon"];
                    }

                }



                $pTitleArray = ["Cantidad de pokemones que evolucionan por $a"];
                $pSubtitleArray = ["Hay $c pokemones que evolucionan por $a"];

                $cTitleArray = ["Cuales son los pokemones que evolucionan por $a"];
                $cImageArray = [$img_Question];
                $cCustomArray = ["Cuales son los pokemones que evolucionan por $a"];

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

            }

            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);

    }

    if(intent('consulta_todosPorEvolucion')) {

            ob_start();

            $a = getIntentParameter()["AtributoEvolucion"];

            ob_end_clean();

            $context = false;
            $contextBody = [];
            $webTitle = ["Oak"];

            if(!$a) {

                ob_start();

                $n = getIntentParameter()["number"];

                $p = getIntentParameter()["Piedra"];

                ob_end_clean();

                if($p) {

                    $ps = Consultas::seleccionaPokemon_evolucionPiedra($p);

                    $pTitleArray = ["Pokemones que evolucionan con una $p"];
                    $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

                    $cTitleArray = [];
                    $cImageArray = [];
                    $cCustomArray = [];

                    for($i=0; $i< count($ps); $i++) {
                        array_push($cTitleArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cCustomArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cImageArray, $img_Pokeball);
                    }

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

                } elseif($n) {


                    ob_start();

                    $comparator = getIntentParameter()["compare"];
            
                    ob_end_clean();

                    if(!$comparator) {

                        $comparator = "igual";

                    }

                    $ps = Consultas::seleccionaPokemon_evolucionNivel($n,$comparator);

                    $pTitleArray = ["Pokemones que evolucionan a un nivel $comparator que el $n"];
                    $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

                    $cTitleArray = [];
                    $cImageArray = [];
                    $cCustomArray = [];

                    for($i=0; $i< count($ps); $i++) {
                        array_push($cTitleArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cCustomArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cImageArray, $img_Pokeball);
                    }

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

                } else {

                    $ps = Consultas::seleccionaPokemon_conEvolucion();

                    $pTitleArray = ["Pokemones que evolucionan"];
                    $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

                    $cTitleArray = [];
                    $cImageArray = [];
                    $cCustomArray = [];

                    for($i=0; $i< count($ps); $i++) {
                        array_push($cTitleArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cCustomArray, $ps[$i]["nombre_pokemon"]);
                        array_push($cImageArray, $img_Pokeball);
                    }

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

                }

            } else {

                $ps = Consultas::seleccionaPokemon_evolucion($a);

                $pTitleArray = ["Pokemones que evolucionan por $a"];
                $pSubtitleArray = ["Quieres saber algo más sobre alguno?"];

                $cTitleArray = [];
                $cImageArray = [];
                $cCustomArray = [];

                for($i=0; $i< count($ps); $i++) {
                    array_push($cTitleArray, $ps[$i]["nombre_pokemon"]);
                    array_push($cCustomArray, $ps[$i]["nombre_pokemon"]);
                    array_push($cImageArray, $img_Pokeball);
                }

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

            }

            webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);


    }
?>