<?php

use Helpers\DatabaseHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;
use Helpers\ValidationHelper;
use Database\MySQLWrapper;

return [
    '' => function() : HTTPRenderer {
        header("Location: /home");
        exit();
    },
    'home' => function() : HTTPRenderer {
        return new HTMLRenderer(
            'component/snippet',
            ['text' => null],
        );
    },
    'about' => function() : HTTPRenderer {
        $lang = $_GET['lang'] ?? 'en';
        return new HTMLRenderer(
            'component/about', 
            ['lang' => $lang],
        );
    },

    'snippet' => function() : HTTPRenderer {
        $uniqueString = $_GET['unique-string'] ?? '';
        $snippet = DatabaseHelper::getPathByUniqueString($uniqueString);

        $id = $snippet['text_id'] ?? null;

        if(!$id) {
            return new HTMLRenderer('component/error', [
                'message' => 'Snippet was missing a text_id'
            ]);
        }

        $text = DatabaseHelper::getTextById($id);


        return new HTMLRenderer('component/snippet', [
            'text' => $text,
        ]);
    },
    'api/snippet' => function() : HTTPRenderer {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            $content = trim($input['content'] ?? '');
            $lang = trim($input['lang'] ?? 'plaintext');
            $uniqueString = trim($input['uniqueString'] ?? null);

            if ($content === '' || $lang === '') {
                return new JSONRenderer([
                    'error' => 'Content and language are required'
                ]);
            }

            if($uniqueString!= null){
                $snippet = DatabaseHelper::getPathByUniqueString($uniqueString);
                if($snippet) {
                    $textId = $snippet['text_id'];
                    $db = new MySQLWrapper();
                    $stmt = $db->prepare("UPDATE texts SET content = ?, lang = ? WHERE id = ?");
                    $stmt->bind_param("ssi", $content, $lang, $textId);
                    $stmt->execute();

                    return new JSONRenderer([
                        'success' => true,
                        'unique_string' => $uniqueString
                    ]);
                }
            }else{
                $db = new MySQLWrapper();

                try {
                    // トランザクション開始
                    $db->begin_transaction();

                    // ① texts 保存
                    $stmt = $db->prepare("
                        INSERT INTO texts (content, lang, syntax_highlighted, created_at, updated_at)
                        VALUES (?, ?, 1,  NOW(), NOW())
                    ");
                    $stmt->bind_param("ss", $content, $lang);
                    $stmt->execute();

                    $textId = $stmt->insert_id;

                    // ② unique string 作成
                    $savedUniqueString = bin2hex(random_bytes(16));

                    // ③ paths 保存
                    $stmt = $db->prepare("
                        INSERT INTO paths (unique_string, text_id, duration, created_at, updated_at)
                        VALUES (?, ?, 3600, NOW(), NOW())
                    ");
                    $stmt->bind_param("si", $savedUniqueString, $textId);
                    $stmt->execute();

                    // 成功したら commit
                    $db->commit();

                    return new JSONRenderer([
                        'success' => true,
                        'unique_string' => $savedUniqueString
                    ]);

                } catch (\Throwable $e) {
                    $db->rollback();

                    error_log("Database error: " . $e->getMessage());

                    return new JSONRenderer([
                        'error' => 'Failed to create snippet'
                    ]);
                }
            }

            return new JSONRenderer([
                'success' => false,
                'unique_string' => null,
            ]);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $uniqueString = $_GET['unique-string'] ?? '';
            $snippet = DatabaseHelper::getPathByUniqueString($uniqueString);

            if (!$snippet) {
                return new JSONRenderer([
                    'error' => 'Snippet not found'
                ]);
            }

            return new JSONRenderer($snippet);
        }

        return new JSONRenderer([
            'error' => 'Method not allowed'
        ]);
    },

    'api/text' => function() : HTTPRenderer {
        $id = ValidationHelper::integer($_GET['id'] ?? null);

        if (!$id) {
            return new JSONRenderer([
                'error' => 'Text ID is required'
            ]);
        }


        $text = DatabaseHelper::getTextById($id);

        if (!$text) {
            return new JSONRenderer([
                'error' => 'Text not found'
            ]);
        }

        return new JSONRenderer($text);
    },
];