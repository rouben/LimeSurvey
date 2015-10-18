<?php
/**
 * Neill requires specific ordering and formatting for data export.
 *
 * Created by IntelliJ IDEA.
 * User: jackwarner
 * Date: 10/18/15
 * Time: 9:01 AM
 */
if (strpos(strtolower($thissurvey['surveyls_title'] ), 'pc for research use') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcrate/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_data.png' alt='<?php eT("Export results to csv"); ?>'/></a>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcchars/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_characteristics.png'
         alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else if (strpos(strtolower($thissurvey['surveyls_title']), 'cc for research use') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportccrate/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_cc_data.png' alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else if (strpos(strtolower($thissurvey['surveyls_title']), 'pc, cc, am, imp, ref') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcccamimpref/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_metaprogram_data.png'
         alt='<?php eT("Export results to csv"); ?>'/></a>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcchars/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_metaprogram_characteristics.png'
         alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else if (strpos(strtolower($thissurvey['surveyls_title']), 'pc, imp, ref for research use') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcimpref/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_data.png' alt='<?php eT("Export results to csv"); ?>'/></a>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcchars/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_characteristics.png'
         alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else if (strpos(strtolower($thissurvey['surveyls_title']), 'pc, imp, ref for clinical') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpcimprefclinical/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_data.png' alt='<?php eT("Export results to csv"); ?>'/></a>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportpccharsclinical/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_pc_characteristics.png'
         alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else if (strpos(strtolower($thissurvey['surveyls_title']), 'cc, imp, ref for research use') !== false) { ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportccimpref/surveyid/$surveyid"); ?>'>
    <img src='/upload/images/exportcsv_cc_data.png' alt='<?php eT("Export results to csv"); ?>'/></a>
<?php } else {
  ?>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportresults/surveyid/$surveyid"); ?>'>
    <img src='<?php echo $sImageURL; ?>export.png'
         alt='<?php eT("Export results to application"); ?>'/></a>
  <a href='<?php echo $this->createUrl("admin/export/sa/exportspss/sid/$surveyid"); ?>'>
    <img src='<?php echo $sImageURL; ?>exportspss.png'
         alt="<?php eT("Export results to a SPSS/PASW command file"); ?>"/></a>
  <?php
}
