<?php 
$db = include "./framework/Connection.php";

interface RestObject {
    function post($query, $content);
    function put($query, $content);
    function get($query);
    function delete($query);
}

return new class implements RestObject {
    function post($query, $content) {
        global $db;

        $pessoa = $db->insert("pessoa", [
            "name" => $content['name'],
            "nickname" => $content['nickname'],
            "email" => $content['email']
        ]);

        foreach($content['phones'] as $phone) {
            $db->insert("telefones", [
                "pessoa" => $pessoa,
                "number" => $phone
            ]);
        }

        return [
            "id" => $pessoa,
            "msg" => "Aewww! inserimos a parada!"
        ];
    }

    function put($query, $content) {
        // ...
    }

    function get($query) {
        return [
            [
                "nome" => "Daniel de Andrade Varela",
                "apelido" => "Drache Havoc",
                "email" => "assassinhora@dunha.com",
                "telefones" => [
                    '1111',
                    '2222'
                ]
            ],
            [
                "nome" => "Daniel de Andrade Varela",
                "apelido" => "Drache Havoc",
                "email" => "assassinhora@dunha.com",
                "telefones" => [
                    '1111',
                    '2222'
                ]
            ],
            [
                "nome" => "Daniel de Andrade Varela",
                "apelido" => "Drache Havoc",
                "email" => "assassinhora@dunha.com",
                "telefones" => [
                    '1111',
                    '2222'
                ]
            ],
        ];    
    }

    function delete($query) {
        
    }
};