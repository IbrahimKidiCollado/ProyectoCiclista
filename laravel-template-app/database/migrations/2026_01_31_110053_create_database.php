<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabase extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------
        | CICLISTA
        |--------------------------------------------------
        */
        Schema::create('ciclista', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 80);
            $table->string('apellidos', 80);
            $table->date('fecha_nacimiento');
            $table->decimal('peso_base', 5, 2)->nullable();
            $table->integer('altura_base')->nullable();
            $table->string('email', 80)->unique();
            $table->string('password', 255);
        });

        /*
        |--------------------------------------------------
        | HISTORICO CICLISTA
        |--------------------------------------------------
        */
        Schema::create('historico_ciclista', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->integer('ftp')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('pulso_reposo')->nullable();
            $table->integer('potencia_max')->nullable();
            $table->decimal('grasa_corporal', 4, 2)->nullable();
            $table->decimal('vo2max', 4, 1)->nullable();
            $table->string('comentario', 255)->nullable();

            $table->unique(
                ['id_ciclista', 'fecha'],
                'uq_ciclista_fecha'
            );
        });

        /*
        |--------------------------------------------------
        | PLAN ENTRENAMIENTO
        |--------------------------------------------------
        */
        Schema::create('plan_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('objetivo', 100)->nullable();
            $table->boolean('activo')->default(true);
        });

        /*
        |--------------------------------------------------
        | BLOQUE ENTRENAMIENTO
        |--------------------------------------------------
        */
        Schema::create('bloque_entrenamiento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->enum('tipo', ['rodaje', 'intervalos', 'fuerza', 'recuperacion', 'test']);
            $table->time('duracion_estimada')->nullable();
            $table->decimal('potencia_pct_min', 5, 2)->nullable();
            $table->decimal('potencia_pct_max', 5, 2)->nullable();
            $table->decimal('pulso_pct_max', 5, 2)->nullable();
            $table->decimal('pulso_reserva_pct', 5, 2)->nullable();
            $table->string('comentario', 255)->nullable();
        });

        /*
        |--------------------------------------------------
        | SESION ENTRENAMIENTO
        |--------------------------------------------------
        */
        Schema::create('sesion_entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_plan')
                ->constrained('plan_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->date('fecha');
            $table->string('nombre', 100)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->boolean('completada')->default(false);
        });

        /*
        |--------------------------------------------------
        | SESION BLOQUE
        |--------------------------------------------------
        */
        Schema::create('sesion_bloque', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_sesion_entrenamiento')
                ->constrained('sesion_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_bloque_entrenamiento')
                ->constrained('bloque_entrenamiento')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->integer('orden');
            $table->integer('repeticiones')->default(1);
        });

        /*
        |--------------------------------------------------
        | TIPO COMPONENTE
        |--------------------------------------------------
        */
        Schema::create('tipo_componente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->string('descripcion', 255)->nullable();
        });

        /*
        |--------------------------------------------------
        | BICICLETA
        |--------------------------------------------------
        */
        Schema::create('bicicleta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->enum('tipo', ['carretera', 'mtb', 'gravel', 'rodillo']);
            $table->string('comentario', 255)->nullable();
        });

        /*
        |--------------------------------------------------
        | COMPONENTES BICICLETA
        |--------------------------------------------------
        */
        Schema::create('componentes_bicicleta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_bicicleta')
                ->constrained('bicicleta')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_tipo_componente')
                ->constrained('tipo_componente')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->string('marca', 50);
            $table->string('modelo', 50)->nullable();
            $table->string('especificacion', 50)->nullable();
            $table->enum('velocidad', ['9v','10v','11v','12v'])->nullable();
            $table->enum('posicion', ['delantera', 'trasera', 'ambas'])->nullable();
            $table->date('fecha_montaje');
            $table->date('fecha_retiro')->nullable();
            $table->decimal('km_actuales', 8, 2)->default(0);
            $table->decimal('km_max_recomendado', 8, 2)->nullable();
            $table->boolean('activo')->default(true);
            $table->string('comentario', 255)->nullable();

            $table->index(
                ['id_bicicleta', 'id_tipo_componente', 'activo'],
                'idx_componentes_activos'
            );
        });

        /*
        |--------------------------------------------------
        | ENTRENAMIENTO
        |--------------------------------------------------
        */
        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_ciclista')
                ->constrained('ciclista')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_bicicleta')
                ->constrained('bicicleta')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('id_sesion')
                ->nullable()
                ->constrained('sesion_entrenamiento')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->dateTime('fecha');
            $table->time('duracion');
            $table->decimal('kilometros', 6, 2);
            $table->string('recorrido', 150);
            $table->integer('pulso_medio')->nullable();
            $table->integer('pulso_max')->nullable();
            $table->integer('potencia_media')->nullable();
            $table->integer('potencia_normalizada');
            $table->decimal('velocidad_media', 5, 2);
            $table->decimal('puntos_estres_tss', 6, 2)->nullable();
            $table->decimal('factor_intensidad_if', 4, 3)->nullable();
            $table->integer('ascenso_metros')->nullable();
            $table->string('comentario', 255)->nullable();

            $table->index(['id_ciclista', 'fecha'], 'idx_ciclista_fecha');
            $table->index(['fecha'], 'idx_fecha');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrenamiento');
        Schema::dropIfExists('componentes_bicicleta');
        Schema::dropIfExists('bicicleta');
        Schema::dropIfExists('tipo_componente');
        Schema::dropIfExists('sesion_bloque');
        Schema::dropIfExists('sesion_entrenamiento');
        Schema::dropIfExists('bloque_entrenamiento');
        Schema::dropIfExists('plan_entrenamiento');
        Schema::dropIfExists('historico_ciclista');
        Schema::dropIfExists('ciclista');
    }
};
