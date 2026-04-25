<?php

namespace Helpers;

use Database\MySQLWrapper;

class DatabaseHelper{
    public static function getTextById(int $id): ?array {
        $db = new MySQLWrapper();
        try{
            $stmt = $db->prepare("SELECT * FROM texts WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt -> execute();
            $result = $stmt->get_result();
            $text = $result->fetch_assoc();

            if(!$text) throw new \Exception("Text snippet not found with id: $id");

            return $text;
        } catch (\Throwable $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }

    public static function getPathByUniqueString(string $uniqueString): ?array {
        $db = new MySQLWrapper();
        try{
            $stmt = $db->prepare("SELECT * FROM paths WHERE unique_string = ?");
            $stmt->bind_param("s", $uniqueString);
            $stmt -> execute();
            $result = $stmt->get_result();
            $snippet = $result->fetch_assoc();

            if($snippet['updated_at'] < date('Y-m-d H:i:s', time() - $snippet['duration'])) {
                $stmt = $db->prepare("DELETE FROM paths WHERE id = ?");
                $stmt->bind_param("i", $snippet['id']);
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM texts WHERE id = ?");
                $stmt->bind_param("i", $snippet['text_id']);
                $stmt->execute();

                throw new \Exception("Snippet has expired and has been deleted.");
            }

            if(!$snippet) throw new \Exception("Snippet not found with unique string: $uniqueString");

            return $snippet;
        } catch (\Throwable $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
    public static function createSnippet(string $content, string $language, ?string $uniqueString = null): array | null {
        $db = new MySQLWrapper();

        try {
            if (!$uniqueString) {
                $uniqueString = bin2hex(random_bytes(16));
                $syntaxHighlighted = 1;
                $duration = 3600;
                $stmt = $db->prepare(
                    "INSERT INTO texts (content, lang, syntax_highlighted, created_at, updated_at) 
                    VALUES (?, ? ,? ,? ,NOW(), NOW())
                    ");
                $stmt->bind_param("ssi", $content, $language, $syntaxHighlighted);
                $stmt->execute();

                $textId = mysqli_insert_id($db);

                $stmt = $db->prepare("INSERT INTO paths (text_id, unique_string,duration,created_at,updated_at) VALUES (?, ?,? ,NOW(), NOW())");
                $stmt->bind_param("isi", $textId, $uniqueString, $duration);
                $stmt->execute();

                return [
                    'text_id' => $textId,
                    'unique_string' => $uniqueString
                ];
            } else {
                $path = self::getPathByUniqueString($uniqueString);

                $textId = $path['text_id'];
                $stmt = $db->prepare("
                    UPDATE texts
                    SET content = ?, lang = ?, updated_at = NOW()
                    WHERE id = ?
                ");
                $stmt->bind_param("ssi", $content, $language, $textId);
                $stmt->execute();

                return [
                    'text_id' => $textId,
                    'unique_string' => $uniqueString
                ];
            }
        } catch (\Throwable $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        }
    }
        
}