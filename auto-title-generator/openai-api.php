<?php
function generate_title_with_openai($prompt, $api_key, $content) {
    $url = 'https://api.openai.com/v1/chat/completions';

    $data = array(
        'model' => 'gpt-4',
        'messages' => array(
            array('role' => 'user', 'content' => $content),
            array('role' => 'system', 'content' => $prompt)
        )
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key,
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);
    $generated_title = trim($response_data['choices'][0]['message']['content']);

    return $generated_title;
}


function atg_register_api_routes() {
    register_rest_route('atg/v1', '/generate_title', array(
        'methods' => 'POST',
        'callback' => 'atg_generate_title_callback',
    ));
}
add_action('rest_api_init', 'atg_register_api_routes');

function atg_generate_title_callback(WP_REST_Request $request) {
    $api_key = get_option('atg_openai_api_key');
    $prompt = $request->get_param('prompt');
    $content = $request->get_param('content');

    $generated_title = generate_title_with_openai($prompt, $api_key, $content);

    return new WP_REST_Response(array('title' => $generated_title), 200);
}