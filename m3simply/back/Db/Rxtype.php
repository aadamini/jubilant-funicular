<?php
/*
namespace Db;

class Rxcode {
    public $needle;
    public $connessione;
   
    public function __construct($needle,$connessione){
        $this->needle = $needle;
        $this->connessione = $connessione;
    }

    public function search(){
        foreach($result as $riga){
            foreach ($riga as $key => $value){
                switch ($value) {
                    case "USERS":
                        $result = $this->connessione->prepare("SELECT t_users.f_code AS 'usecode',
                                t_creation_date.f_id,
                                t_creation_date.f_category,
                                t_creation_date.f_creation_date,
                                t_creation_date.f_creation_user,
                                t_creation_date.f_title,
                                t_creation_date.f_description,
                                t_creation_date.f_wf_id,
                                t_creation_date.f_phase_id,
                                t_creation_date.f_visibility,
                                t_creation_date.f_editability,
                                t_creation_date.f_timestamp,
                                t_creation_date.fc_hierarchy,
                                t_creation_date.fc_progress,
                                t_creation_date.fc_contracts,
                                t_creation_date.fc_editor_user_name,
                                t_creation_date.fc_creation_user_name,
                                t_creation_date.fc_creation_user_mail,
                                t_creation_date.fc_work_instructions,

                                t_wares.f_id,
                                t_wares.f_code,
                                t_wares.f_type_id,
                                t_wares.f_timestamp,
                                t_wares.f_order,
                                t_wares.f_user_id,
                                t_wares.f_priority,
                                t_wares.f_start_date,
                                t_wares.fc_imp_code_wares_excel,
                                t_wares.fc_asset_opened_wo,
                                t_wares.fc_asset_opened_pm,
                                t_wares.fc_asset_wo,
                                t_wares.f_subtitle_wiz,
                                t_wares.f_imgtile_wiz,
                                t_wares.f_order_wiz,
                                t_wares.f_field_wiz,
                                t_wares.f_color_wiz,
                                t_wares.f_tilewidth_wiz,
                                t_wares.f_srcbox_wiz

                                FROM t_creation_date 

                                LEFT JOIN t_wares
                                ON t_creation_date.f_id=t_wares.f_code

                                LEFT JOIN t_ware_wo AS wa_wo
                                ON t_wares.f_code=wa_wo.f_ware_id

                                LEFT JOIN t_users 
                                ON t_creation_date.f_id=t_users.f_code

                                WHERE  t_creation_date.f_category =:id");
                                $id = $this->needle;

                                $result->execute(
                                    array(":id" => $id,
                                    )
                                );
                        break;
                    case "WORKORDERS":
                        $result = $this->connessione->prepare("SELECT t_workorders.f_code AS 'worcode',
                                t_creation_date.f_id,
                                t_creation_date.f_category,
                                t_creation_date.f_creation_date,
                                t_creation_date.f_creation_user,
                                t_creation_date.f_title,
                                t_creation_date.f_description,
                                t_creation_date.f_wf_id,
                                t_creation_date.f_phase_id,
                                t_creation_date.f_visibility,
                                t_creation_date.f_editability,
                                t_creation_date.f_timestamp,
                                t_creation_date.fc_hierarchy,
                                t_creation_date.fc_progress,
                                t_creation_date.fc_contracts,
                                t_creation_date.fc_editor_user_name,
                                t_creation_date.fc_creation_user_name,
                                t_creation_date.fc_creation_user_mail,
                                t_creation_date.fc_work_instructions,

                                t_workorders.f_id,
                                t_workorders.f_type_id,
                                t_workorders.f_code,
                                t_workorders.f_code_periodic,
                                t_workorders.f_code_task,
                                t_workorders.f_timestamp,
                                t_workorders.f_user_id,
                                t_workorders.f_priority,
                                t_workorders.f_start_date,
                                t_workorders.f_end_date,
                                t_workorders.fc_imp_code_wo_excel,
                                t_workorders.fc_wo_starting_date,
                                t_workorders.fc_wo_ending_date,
                                t_workorders.fc_pm_start_date,
                                t_workorders.fc_pm_end_date,
                                t_workorders.fc_pm_next_due_date,
                                t_workorders.fc_pm_subsequent_due_date,
                                t_workorders.fc_wo_asset,
                                t_workorders.fc_owner_name

                                FROM t_creation_date 

                                LEFT JOIN t_wares
                                ON t_creation_date.f_id=t_wares.f_code

                                LEFT JOIN t_ware_wo AS wa_wo
                                ON t_wares.f_code=wa_wo.f_ware_id



                                LEFT JOIN t_workorders 
                                ON t_creation_date.f_id=t_workorders.f_code

                                LEFT JOIN t_ware_wo AS wo_wa
                                ON t_workorders.f_code=wo_wa.f_wo_id

                                WHERE  t_workorders.f_code =:id");
                                $id = $this->needle;

                                $result3->execute(
                                    array(":id" => $id,
                                    )
                                );
                        break;
                    case "SELECTORS":
                        $result = $this->connessione->prepare("SELECT t_selectors.f_code AS 'selcode',
                                t_creation_date.f_id,
                                t_creation_date.f_category,
                                t_creation_date.f_creation_date,
                                t_creation_date.f_creation_user,
                                t_creation_date.f_title,
                                t_creation_date.f_description,
                                t_creation_date.f_wf_id,
                                t_creation_date.f_phase_id,
                                t_creation_date.f_visibility,
                                t_creation_date.f_editability,
                                t_creation_date.f_timestamp,
                                t_creation_date.fc_hierarchy,
                                t_creation_date.fc_progress,
                                t_creation_date.fc_contracts,
                                t_creation_date.fc_editor_user_name,
                                t_creation_date.fc_creation_user_name,
                                t_creation_date.fc_creation_user_mail,
                                t_creation_date.fc_work_instructions,

                                FROM t_creation_date 

                                LEFT JOIN t_selectors
                                ON t_creation_date.f_id=t_selectors.f_code

                                WHERE t_selectors.f_code =:id");
                                $id = $this->needle;

                                $result4->execute(
                                    array(":id" => $id,
                                    )
                                );
                        break;
                    default:
                        $result = $this->connessione->prepare("SELECT t_wares.f_code AS 'warcode',
                                t_creation_date.f_id,
                                t_creation_date.f_category,
                                t_creation_date.f_creation_date,
                                t_creation_date.f_creation_user,
                                t_creation_date.f_title,
                                t_creation_date.f_description,
                                t_creation_date.f_wf_id,
                                t_creation_date.f_phase_id,
                                t_creation_date.f_visibility,
                                t_creation_date.f_editability,
                                t_creation_date.f_timestamp,
                                t_creation_date.fc_hierarchy,
                                t_creation_date.fc_progress,
                                t_creation_date.fc_contracts,
                                t_creation_date.fc_editor_user_name,
                                t_creation_date.fc_creation_user_name,
                                t_creation_date.fc_creation_user_mail,
                                t_creation_date.fc_work_instructions,

                                t_wares.f_id,
                                t_wares.f_code,
                                t_wares.f_type_id,
                                t_wares.f_timestamp,
                                t_wares.f_order,
                                t_wares.f_user_id,
                                t_wares.f_priority,
                                t_wares.f_start_date,
                                t_wares.fc_imp_code_wares_excel,
                                t_wares.fc_asset_opened_wo,
                                t_wares.fc_asset_opened_pm,
                                t_wares.fc_asset_wo,
                                t_wares.f_subtitle_wiz,
                                t_wares.f_imgtile_wiz,
                                t_wares.f_order_wiz,
                                t_wares.f_field_wiz,
                                t_wares.f_color_wiz,
                                t_wares.f_tilewidth_wiz,
                                t_wares.f_srcbox_wiz

                                FROM t_creation_date 

                                LEFT JOIN t_wares
                                ON t_creation_date.f_id=t_wares.f_code

                                LEFT JOIN t_ware_wo AS wa_wo
                                ON t_wares.f_code=wa_wo.f_ware_id

                                WHERE  t_wares.f_code =:id");
                                $id = $this->needle;

                                $result->execute(
                                    array(":id" => $id,
                                    )
                                );
                }
                
foreach($result as $riga){
    foreach ($riga as $key => $value){
        echo "$key : $value";
    }
}  
            }

        }
    }
}