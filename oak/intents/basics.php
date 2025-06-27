<?php

    if(intent("basics_welcome")) {
        $context = false;
        $contextBody = [];
        $webTitle = ["Oak"];

        $imageArray = ["https://8a33-2a0c-5a84-780d-e400-cc60-9318-7420-d6d9.ngrok-free.app/chatbots/oak/core/images/Generacion.png"];
        $aTitleArray = ["Buenas"];
        $aSubtitleArray = ["Soy un chatbot que facilita la interacción con una base de datos mysql, este es el modelo de datos de la base de datos"];
        $aTextArray = ["Elige que deseas hacer a continuación"];

        $bTitleArray = ["Ver el modelo relacional","Ver algunos ejemplos","Seguir por mi cuenta"];
        $bCustomArray = ["relacional","ejemplos","seguir"];
        $bImageArray = [$img_Sql,$img_Template,$img_Chatbot];


        $structure = [
                        'image',
                        'comma',
                        'card',
                        'superDivider',
                        'reply'
                    ];

        $components = [
                        [$imageArray,$webTitle],
                        [],
                        [$aTitleArray,$aSubtitleArray,$aTextArray],
                        [],
                        [$bTitleArray,$bImageArray,$bCustomArray,]
                    ];

        webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);
    }

    if(intent("basics_example")) {
        $context = false;
        $contextBody = [];
        $webTitle = ["Oak"];

        $aTitleArray = ["Title"];
        $aTextArray = [["Text1","Text2"]];

        $bTitleArray = ["Ver el modelo relacional","Seguir por mi cuenta"];
        $bCustomArray = ["relacional","seguir"];
        $bImageArray = [$img_Sql,$img_Chatbot];

        $structure = [
                        'description',
                        'superDivider',
                        'reply'
                    ];

        $components = [
                        [$aTitleArray,$aTextArray],
                        [],
                        [$bTitleArray,$bImageArray,$bCustomArray,]
                    ];

        webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);
    }

    if(intent("basics_model")) {
        $context = false;
        $contextBody = [];
        $webTitle = ["Oak"];

        $imageArray = ["https://8a33-2a0c-5a84-780d-e400-cc60-9318-7420-d6d9.ngrok-free.app/chatbots/oak/core/images/Modelo.png"];
        $aTitleArray = ["Modelo relacional"];
        $aSubtitleArray = ["Este es el modelo de la base de datos que estamos utilizando"];
        $aTextArray = ["Elige que deseas hacer a continuación"];

        $bTitleArray = ["Ver algunos ejemplos", "Seguir por mi cuenta"];
        $bCustomArray = ["ejemplos", "seguir"];
        $bImageArray = [$img_Template,$img_Chatbot];

        $structure = [
                        'image',
                        'comma',
                        'card',
                        'superDivider',
                        'reply'
                    ];

        $components = [
                        [$imageArray,$webTitle],
                        [],
                        [$aTitleArray,$aSubtitleArray,$aTextArray],
                        [],
                        [$bTitleArray,$bImageArray,$bCustomArray,]
                    ];

        webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);
    }

    if(intent("basics_continue")) {
        $context = false;
        $contextBody = [];
        $webTitle = ["Oak"];

        $pTitleArray = ["Adelante"];
        $pSubtitleArray = ["Estoy listo para devolver la información que solicites"];

        

        $structure = [
                        'paragraph'
                    ];

        $components = [
                        [$pTitleArray,$pSubtitleArray]
                    ];

        webStructureTemplate($context, $contextBody, $webTitle, $structure, $components);
    }
?>