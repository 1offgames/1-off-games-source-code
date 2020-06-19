<?php

function displayAvailableSetting($targetField, $dateAccepted, $name, $id)
{
  // Defaults
  $editableField = "<input type='text' class='form-control' id='$id' name='$id' placeholder='$targetField'>";
  $button = '';

  // Username Logic
  if ($name == 'Username') {
    $editableField = "<input type='text' class='form-control-plaintext' id='$id' name='$id' placeholder='$targetField' disabled>";
  }

  // Privacy Policy Logic
  if ($targetField == 1) {
    $targetField = 'Accepted at ' . $dateAccepted;
    $button = "<a href='privacypolicy.php'><div class='btn btn-danger' id='$id'>View</div></a>";
    $editableField = "<input type='text' class='form-control-plaintext' id='$id' name='$id' placeholder='$targetField' disabled>";
  }

  // Email Logic
  if ($name == 'Email') {
    $editableField = "<input type='email' class='form-control' id='$id' name='$id' placeholder='$targetField'>";
  }

  // Province Logic
  if ($name == 'Province/Territory') {
    $editableField = "
                      <select class='form-control placeholder-gray' id='$id' name='$id' type='text'>
                        <option value='' class='placeholder-gray' disabled selected hidden>$targetField</option>
                        <option value='AB'>AB</option>
                        <option value='BC'>BC</option>
                        <option value='MB'>MB</option>
                        <option value='NB'>NB</option>
                        <option value='NL'>NL</option>
                        <option value='NT'>NT</option>
                        <option value='NS'>NS</option>
                        <option value='NU'>NU</option>
                        <option value='ON'>ON</option>
                        <option value='PE'>PE</option>
                        <option value='QC'>QC</option>
                        <option value='SK'>SK</option>
                        <option value='YT'>YT</option>
                      </select>";
  }

  // Returned Element
  $element = "
      <div class='form-group row'>
        <label for='$name' class='col-md-4 col-form-label'>$name:</label>
        <div class='col-md-8'>
          $editableField
        </div>
        <div class='col-md-2'>
          $button
        </div>
      </div>
    ";
  echo $element;
}
