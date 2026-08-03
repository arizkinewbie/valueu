<?php
namespace App\Models\Builtin;

class SettingLayoutModel extends \App\Models\BaseModel
{
    /**
     * Allowed font sizes (whitelist)
     */
    private array $allowedFontSizes = [10, 11, 12, 13, 14, 15, 16, 18, 20, 22, 24];

    /**
     * Allowed parameters for layout settings
     */
    private array $layoutParams = [
        'color_scheme',
        'bootswatch_theme',
        'sidebar_color',
        'logo_background_color',
        'font_family',
        'font_size',
    ];

    public function getDefaultSetting(): array
    {
        $sql = 'SELECT * FROM setting WHERE type = ?';
        $data = $this->db->query($sql, ['layout'])->getResultArray();
        return $data;
    }

    public function getUserSetting(): ?array
    {
        if (empty($_SESSION['user']['id_user'])) {
            return null;
        }

        $sql = 'SELECT * FROM setting_user WHERE id_user = ? AND type = ?';
        $data = $this->db->query($sql, [
            (int) $_SESSION['user']['id_user'],
            'layout'
        ])->getRowArray();

        return $data;
    }

    public function saveData(): bool
    {
        $request = service('request');
        $result = false;

        if (empty($_SESSION['user']['id_user']) || empty($_SESSION['user']['permission'])) {
            return false;
        }

        // Validate and sanitize all input
        $arr = [];
        $data_db = [];

        foreach ($this->layoutParams as $param) {
            $value = $request->getPost($param);

            if ($value === null) {
                return false;
            }

            // Sanitize: only allow alphanumeric, hyphens, underscores, hash, spaces
            $value = trim($value);
            if (!preg_match('/^[a-zA-Z0-9\-_#\s\.]+$/', $value)) {
                return false;
            }

            $data_db[] = ['type' => 'layout', 'param' => $param, 'value' => $value];
            $arr[$param] = $value;
        }

        // Validate font_size specifically
        $fontSize = (int) $arr['font_size'];
        if (!in_array($fontSize, $this->allowedFontSizes, true)) {
            return false;
        }

        if (array_key_exists('update_all', $_SESSION['user']['permission'])) {
            $this->db->transStart();
            $this->db->table('setting')->delete(['type' => 'layout']);
            $this->db->table('setting')->insertBatch($data_db);
            $this->db->transComplete();
            $result = $this->db->transStatus();

        } elseif (array_key_exists('update_own', $_SESSION['user']['permission'])) {
            $this->db->transStart();
            $this->db->table('setting_user')->delete([
                'id_user' => (int) $_SESSION['user']['id_user'],
                'type' => 'layout',
            ]);
            $this->db->table('setting_user')->insert([
                'id_user' => (int) $_SESSION['user']['id_user'],
                'param' => json_encode($arr),
                'type' => 'layout',
            ]);
            $this->db->transComplete();
            $result = $this->db->transStatus();
        }

        return $result;
    }


}
