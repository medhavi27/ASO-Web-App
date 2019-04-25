<?php
// vvv DO NOT MODIFY/REMOVE vvv

// check current php version to ensure it meets 2300's requirements
function check_php_version()
{
  if (version_compare(phpversion(), '7.0', '<')) {
    define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
    echo VERSION_MESSAGE;
    throw VERSION_MESSAGE;
  }
}
check_php_version();

function config_php_errors()
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 0);
  error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename)
{
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (file_exists($init_sql_filename)) {
      $db_init_sql = file_get_contents($init_sql_filename);
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    } else {
      unlink($db_filename);
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return null;
}

function exec_sql_query($db, $sql, $params = array())
{
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return null;
}
$db = open_or_init_sqlite_db('secure/site.sqlite', 'secure/init.sql');
// ^^^ DO NOT MODIFY/REMOVE ^^^

// You may place any of your code here.
/* Source: Kyle Harms: lab 8 code rewritten */
define('SESSION_COOKIE_DURATION', 60*60*1);
$session_messages = array();
function log_in($username, $password) {
  global $db;
  global $current_user;
  global $session_messages;
  if (isset($username) && isset($password) ) {
    //Goes through database to check for username
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // check first/only result in records
      $account = $records[0];
      // this built in function checks if the hash and password match
      if (password_verify($password, $account['password']) ) {
        // creates a NEW session
        $session = session_create_id();
        // stores this session in our database
        $sql = "INSERT INTO sessions (user_id, session) VALUES (:user_id, :session);";
        $params = array(
          ':user_id' => $account['id'],
          ':session' => $session
        );
        $result = exec_sql_query($db, $sql, $params);
        //if the query executes then store the session
        if ($result) {
          // built-in function to send back session
          setcookie("session", $session, time() + SESSION_COOKIE_DURATION);
          $current_user = $account;
          return $current_user;
        } else {
          array_push($session_messages, "Unable to Login");
        }
      } else {
        array_push($session_messages, "Your username or password is wrong.");
      }
    } else {
      array_push($session_messages, "Your username is invalid.");
    }
  } else {
    array_push($session_messages, "Enter a username and password.");
  }
  $current_user = NULL;
  return NULL;
}
function find_this_user($user_id) {
  global $db;
  $sql = "SELECT * FROM users WHERE id = :user_id;";
  $params = array(
    ':user_id' => $user_id
  );
  $records = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($records) {
    //first and only element in our search results for username
    return $records[0];
  }
  return NULL;
}
function find_this_session($session) {
  global $db;
  if (isset($session)) {
    $sql = "SELECT * FROM sessions WHERE session = :session;";
    $params = array(
      ':session' => $session
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      //first and only element in our search results for sessions
      return $records[0];
    }
  }
  return NULL;
}
function session_login() {
  global $db;
  global $current_user;
  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];
    $session_record = find_this_session($session);
    if ( isset($session_record) ) {
      //renews the session for another hour
      $current_user = find_this_user($session_record['user_id']);
      setcookie("session", $session, time() + SESSION_COOKIE_DURATION);
      return $current_user;
    }
  }
  $current_user = NULL;
  return NULL;
}
function is_user_logged_in() {
  global $current_user;
  // check if someone is logged in by checking if curren_user's not null
  return ($current_user != NULL);
}
function log_out() {
  global $current_user;
  // set a cookie with time in the past (this way it expires)
  setcookie('session', '', time() - SESSION_COOKIE_DURATION);
  $current_user = NULL;
}
// Code to check if we should log in or log out
if ( isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']) ) {
  $username = trim( $_POST['username'] );
  $password = trim( $_POST['password'] );
  log_in($username, $password);
} else {
  // to rewnew the cookie
  session_login();
}
if ( isset($current_user) && ( isset($_GET['logout']) || isset($_POST['logout']) ) ) {
  log_out();
}
?>
