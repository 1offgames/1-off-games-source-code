<?php

// Returns a green (success), or red (failure) alert box with inputted text 
function alert($returnString, $result)
{
  $element = "
      <div class='alert alert-dismissible $result fixed-top alert-position'>
        <button type='button' class='close' data-dismiss='alert' aria-label='close' onclick=\"this.parentElement.style.display='none';\">&times;</button>\n
        <strong id='alertBoxText'>$returnString</strong>\n
      </div>
    ";
  echo $element;
}
