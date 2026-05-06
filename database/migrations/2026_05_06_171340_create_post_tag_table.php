<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * NOTE: This table and its FK constraints already existed in the DB
     * before this migration was created, so up() is intentionally a no-op.
     * The intended schema is documented here for reference.
     *
     * post_tag:
     *   post_id BIGINT UNSIGNED FK -> posts.id ON DELETE CASCADE
     *   tag_id  BIGINT UNSIGNED FK -> tags.id  ON DELETE CASCADE
     *   PRIMARY KEY (post_id, tag_id)
     */
    public function up(): void
    {
        // Table and constraints already exist — nothing to do.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
