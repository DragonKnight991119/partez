<?php 
echo json_encode(
    array_merge(
        ["Hello" => "world!", "message" => "This comes from your wonderfull API."],
        $_GET
    )
);