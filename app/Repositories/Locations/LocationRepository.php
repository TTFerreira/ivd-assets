<?php

namespace App\Repositories\Locations;

use App\Location;
use Session;
use Slack;

class LocationRepository implements LocationRepositoryInterface {
  public function getAll()
  {
    return Location::all();
  }

  public function getLatest()
  {
    return Location::get()->last();
  }

  public function find($id)
  {
    return Location::findOrFail($id);
  }

  public function store($request)
  {
    Location::create($request->all());
  }

  public function update($request, $model)
  {
    $model->update($request->all());
  }

  public function flashSuccessCreate($title)
  {
    Session::flash('status', 'success');
    Session::flash('title', $title);
    Session::flash('message', 'Successfully created');
  }

  public function flashSuccessUpdate($title)
  {
    Session::flash('status', 'success');
    Session::flash('title', $title);
    Session::flash('message', 'Successfully updated');
  }

  public function slackCreate()
  {
    Slack::attach([
        'fallback' => 'New Location Created',
        'text' => 'New Location Created',
        'color' => 'good',
        'fields' => [
          [
            'title' => 'Building',
            'value' => $this->getLatest()->building,
            'short' => true
          ],
          [
            'title' => 'Office',
            'value' => $this->getLatest()->office,
            'short' => true
          ],
          [
            'title' => 'Location Name',
            'value' => $this->getLatest()->location_name
          ]
        ]
      ])->send();
  }

  public function slackUpdate($id)
  {
    Slack::attach([
        'fallback' => 'Location Updated',
        'text' => 'Location Updated',
        'color' => 'good',
        'fields' => [
          [
            'title' => 'Building',
            'value' => $this->find($id)->building,
            'short' => true
          ],
          [
            'title' => 'Office',
            'value' => $this->find($id)->office,
            'short' => true
          ],
          [
            'title' => 'Location Name',
            'value' => $this->find($id)->location_name
          ]
        ]
      ])->send();
  }
}
