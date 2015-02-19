<?php
include_once('helpers.php');

session_destroy();

Redirect('/admin/index.php', false);
