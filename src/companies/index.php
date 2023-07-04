<?php
require __DIR__ . '/lib/escape.php';
require __DIR__ . '/lib/mysqli.php';
function ListCompanies($link)
{
  $companies = [];
  $sql ='SELECT name, establishment_date, founder FROM companies';
  $result = mysqli_query($link, $sql);
  while ($company = mysqli_fetch_assoc($result)){
    $companies[] = $company;
  }
  mysqli_free_result($result);

  return $companies;
}

$link = dbConnect();
$companies = ListCompanies($link);


$title = '会社情報一覧';
$content = __DIR__ . '/views/index.php';
include  __DIR__ . '/views/layout.php';
