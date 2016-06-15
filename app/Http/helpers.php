<?php

  function hasErrorForClass($errors, $column) {
    if(count($errors)) {
      if ($errors->has($column)) {
        return 'has-error';
      }
    }
  }

  function hasErrorForField($errors, $column) {
    if(count($errors)) {
      if ($errors->has($column)) {
        print '<span class="help-block">' . $errors->first($column) . '</span>';
      }
    }
  }
