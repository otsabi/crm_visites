<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapportMedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapport_meds', function (Blueprint $table) {
            $table->bigIncrements('rapport_med_id');
            $table->date('Date_de_visite');
            $table->string('Nom_Prenom');
            $table->string('Specialité');
            $table->string('Etablissement');
            $table->string('Potentiel');
            $table->unsignedBigInteger('Montant_Inv_Précédents');
            $table->string('Zone_Ville');

            $table->string('P1_présenté');
            $table->string('P1_Feedback');
            $table->integer('P1_Ech');

            $table->string('P2_présenté');
            $table->string('P2_Feedback');
            $table->integer('P2_Ech');

            $table->string('P3_présenté');
            $table->string('P3_Feedback');
            $table->integer('P3_Ech');

            $table->string('P4_présenté');
            $table->string('P4_Feedback');
            $table->integer('P4_Ech');

            $table->string('P5_présenté');
            $table->string('P5_Feedback');
            $table->integer('P5_Ech');

            $table->string('Materiel_Promotion');
            $table->string('Invitation_promise');
            $table->string('Plan/Réalisé');
            $table->string('Visite_Individuelle/Double');

            $table->string('DELEGUE');
            $table->integer('DELEGUE_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapport_meds');
    }
}
