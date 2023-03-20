<?php

namespace Database\Seeders\Tenant;

use App\Models\Business\Planning\PrioritizationTemplate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PrioritizationTemplatesSeeder extends Seeder
{

    public function run()
    {

        DB::table('prioritization_templates')->insert(array(
            0 =>
                array(
                    'description' => 'Metodología Inicial (por defecto)',
                    'status' => PrioritizationTemplate::STATUS_DEFAULT,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'configuration' => '[
                      {
                        "id": 1,
                        "scope": "Estado",
                        "weight": 0.1,
                        "criteria": [
                          {
                            "id": 1,
                            "question": "¿Es proyecto de arrastre?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          }
                        ]
                      },
                      {
                        "id": 2,
                        "scope": "Económico",
                        "weight": 0.3,
                        "criteria": [
                          {
                            "id": 1,
                            "question": "¿Incorpora mano de obra local?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 2,
                            "question": "¿Refuerza encadenamientos productivos?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 3,
                            "question": "¿Mejora la productividad del sector por mejor acceso a agua o movilidad?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 3
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 4,
                            "question": "¿Incorpora tecnología y fomenta su transferencia a la zona de influencia?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 5,
                            "question": "Nivel de beneficio económico  del proyecto",
                            "answers": [
                              {
                                "name": "BAJO",
                                "value": 1
                              },
                              {
                                "name": "MEDIO",
                                "value": 2
                              },
                              {
                                "name": "ALTO",
                                "value": 3
                              }
                            ]
                          }
                        ]
                      },
                      {
                        "id": 3,
                        "scope": "Ambiental",
                        "weight": 0.2,
                        "criteria": [
                          {
                            "id": 1,
                            "question": "¿Tiene impacto ambiental?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 0
                              },
                              {
                                "name": "NO",
                                "value": 1
                              }
                            ]
                          },
                          {
                            "id": 2,
                            "question": "¿Existen estrategias para mitigar el impacto ambiental?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 3,
                            "question": "Nivel de impacto ambiental en la zona",
                            "answers": [
                              {
                                "name": "BAJO",
                                "value": 3
                              },
                              {
                                "name": "MEDIO",
                                "value": 2
                              },
                              {
                                "name": "ALTO",
                                "value": 1
                              }
                            ]
                          }
                        ]
                      },
                      {
                        "id": 4,
                        "scope": "Político / Articulación",
                        "weight": 0.2,
                        "criteria": [
                          {
                            "id": 1,
                            "question": "¿Fue priorizado por el Ejecutivo del GADP?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 2,
                            "question": "¿Fue priorizado por la Asamblea local?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 3,
                            "question": "¿Involucra la participación de actores presentes en el territorio nacional / privado?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 4,
                            "question": "Nivel de importancia autoridad GAD",
                            "answers": [
                              {
                                "name": "BAJO",
                                "value": 1
                              },
                              {
                                "name": "MEDIO",
                                "value": 2
                              },
                              {
                                "name": "ALTO",
                                "value": 3
                              }
                            ]
                          }
                        ]
                      },
                      {
                        "id": 5,
                        "scope": "Social",
                        "weight": 0.2,
                        "criteria": [
                          {
                            "id": 1,
                            "question": "¿Beneficia a grupos prioritarios?",
                            "answers": [
                              {
                                "name": "SI",
                                "value": 1
                              },
                              {
                                "name": "NO",
                                "value": 0
                              }
                            ]
                          },
                          {
                            "id": 2,
                            "question": "¿A cuántos grupos prioritarios?",
                            "answers": [
                              {
                                "name": "CERO",
                                "value": 0
                              },
                              {
                                "name": "UNO",
                                "value": 1
                              },
                              {
                                "name": "DOS",
                                "value": 2
                              },
                              {
                                "name": "TRES",
                                "value": 3
                              },
                              {
                                "name": "CUATRO",
                                "value": 4
                              },
                              {
                                "name": "CINCO",
                                "value": 5
                              }
                            ]
                          },
                          {
                            "id": 3,
                            "question": "Nivel de beneficio social del proyecto",
                            "answers": [
                              {
                                "name": "BAJO",
                                "value": 1
                              },
                              {
                                "name": "MEDIO",
                                "value": 2
                              },
                              {
                                "name": "ALTO",
                                "value": 3
                              }
                            ]
                          }
                        ]
                      }
                    ]'
                )
        ));
    }
}
