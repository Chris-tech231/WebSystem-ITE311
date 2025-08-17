<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Enable/Disable Migrations
     * --------------------------------------------------------------------------
     *
     * Set to true whenever you want to run schema migrations.
     */
    public bool $enabled = true;

    /**
     * --------------------------------------------------------------------------
     * Migrations Table
     * --------------------------------------------------------------------------
     *
     * This table stores the current state of all migrations.
     */
    public string $table = 'migrations';

    /**
     * --------------------------------------------------------------------------
     * Timestamp Format
     * --------------------------------------------------------------------------
     *
     * Controls how migration filenames are generated.
     * 
     * Recommended for "sequential-like" numbering:
     * - 'YmdHis_'  → 20250817120000_CreateUsers.php
     *
     * Other supported formats:
     * - 'Y-m-d-His_'
     * - 'Y_m_d_His_'
     */
    public string $timestampFormat = 'YmdHis_'; // behaves like sequential order
}
