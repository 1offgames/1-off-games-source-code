<?php

// Returns the privacy policy text
function displayPrivacyPolicy()
{
  $element = "
      <div class='modal-body'>
        <p>The Canadian federal government will be introducing a new privacy protection law within a few months called
        the “General Data Protection Regulation”. This law will require that individuals must give explicit permission
        for their data to be used and give individuals the right to know who is accessing their information and what it
        will be used for. All companies collecting and/or using personal information on Canadian citizens must comply
        with this new law.</p>

          <p>Data to be collected is:
            <ul>
              <li>Date last login</li>
              <li>Date privacy terms accepted</li>
            </ul>
          </p>
      </div>
    ";
  echo $element;
}
