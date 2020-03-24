<?php

class Survey {

    public function listSurveys($dbcon){
        $sql = "SELECT * FROM surveys";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $surveys = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        return $surveys;
    }
    public function deleteSurvey($dbcon,$survey_id){
        $sql = "DELETE FROM surveys WHERE survey_id = :survey_id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':survey_id', $survey_id);
        $count = $pst->execute();
        return $count;
    }
    public function displaySurvey($dbcon, $survey_id){

        $sql = "SELECT * FROM surveys where survey_id = :survey_id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':survey_id', $survey_id);
        $pst->execute();
        $indSurvey = $pst->fetch(PDO::FETCH_OBJ);
        return $indSurvey;

}
}

?>