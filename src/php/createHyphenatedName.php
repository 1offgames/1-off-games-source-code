<?php

function createHyphenatedName($categoryName)
{
  // replace spaces with -
  $categoryName = str_replace(' ', '-', $categoryName);

  // Removes special chars.
  $categoryName = preg_replace('/[^A-Za-z0-9\-]/', '', $categoryName);

  return strtolower($categoryName);
}
