<?php
session_start();
session_destroy();
header("Location: ../Site/index.html");
exit;