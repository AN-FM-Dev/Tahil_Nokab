<!DOCTYPE html>
<html lang="ar" dir="rtl">
   
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="../../style.css?v=<?= time() ?>">
   <title>نخب | الأسبوع <?php 
   if ($pageName === "level_1_1") {echo 'الأول';}
   elseif ($pageName === "level_1_2") {echo 'الثاني';}
   elseif ($pageName === "level_1_3") {echo 'الثالث';}
   elseif ($pageName === "level_1_4") {echo 'الرابع';}
   elseif ($pageName === "level_1_5") {echo 'الخامس';}
   elseif ($pageName === "level_1_6") {echo 'السادس';}
   elseif ($pageName === "level_1_7") {echo 'السابع';}
   elseif ($pageName === "level_1_8") {echo 'الثامن';}
   elseif ($pageName === "level_1_9") {echo 'التاسع';}
   elseif ($pageName === "level_1_10") {echo 'العاشر';}
   elseif ($pageName === "level_1_11") {echo 'الأول';}
   elseif ($pageName === "level_1_12") {echo 'الأول';}
   elseif ($pageName === "level_1_13") {echo 'الأول';}
   elseif ($pageName === "level_1_14") {echo 'الأول';}
   ?></title>

</head>
<body>

<section id="week">

<?php if (!empty($blockValues)) { ?>
    <table id="sheetTable">
      <?php foreach ($blockValues as $row) { ?>
        <tr>
          <?php foreach ($row as $cell) { ?>
            <td><?= htmlspecialchars($cell) ?></td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
  <?php } ?>

<?php if (!empty($cellValue_2)) { $K1 = $cellValue_2[0][0] ?? ''; ?>
  <div class="K1"><?= htmlspecialchars($K1); ?></div>
<?php } ?>

<?php if (!empty($cellValue_1)) { $J1 = $cellValue_1[0][0] ?? ''; ?>
  <div class="J1"><?= htmlspecialchars($J1); ?></div>
<?php } ?>

   </section>

</body>
</html>
