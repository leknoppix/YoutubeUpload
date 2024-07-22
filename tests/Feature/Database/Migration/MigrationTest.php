<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class MigrationTest extends TestCase
{
    use RefreshDatabase;

    public function testDownMigration()
    {
        // Appellez la méthode up pour créer la table
        Artisan::call('migrate');

        // Assurez-vous que la table existe
        $this->assertTrue(Schema::hasTable('youtubeupload_videos'));

        // Appellez la méthode down pour supprimer la table
        Artisan::call('migrate:rollback');

        // Assurez-vous que la table a été supprimée
        $this->assertFalse(Schema::hasTable('youtubeupload_videos'));
    }

    public function test_creation_all_database_tables()
    {
        Artisan::call('migrate');
        $this->assertTrue(Schema::hasTable('youtubeupload_videos'));
        $this->assertTrue(Schema::hasTable('youtubeupload_channel'));
        $this->assertTrue(Schema::hasTable('youtubeupload_access_tokens'));
    }
    }
