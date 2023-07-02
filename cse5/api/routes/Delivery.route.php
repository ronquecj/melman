<?php

if ($req[0] == 'getclients'):
  echo json_encode($gm->callNoData('getclients'));
  return;
endif;

if ($req[0] == 'getclient'):
  echo json_encode($gm->callWithData('getClient', $d));
  return;
endif;
