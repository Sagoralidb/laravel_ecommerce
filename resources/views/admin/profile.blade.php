@extends('layouts.admin')

@section('title','Profile')

@section('css')
    
@endsection

@section('content')

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
            <div class="content"><!-- For Components documentaion -->
  <div class="card card-default">
    <div class="px-6 py-4">
      <p>Mono provides a variety of <span class="text-secondary text-capitalize"> Bootstrap tables </span> components with a
        little customization that suits its design standards. For more information, please see the official <a class="font-weight-bold" href="https://getbootstrap.com/docs/4.3/content/tables/" target="_blank"> Bootstrap documentation.</a></p>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xl-12">
      <!-- Basic Table-->
      <div class="card card-default">
        <div class="card-header">
          <h2>Basic Table</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-1" role="button"
            aria-expanded="false" aria-controls="collapse-table-1"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-1">
            <pre class="language-html mb-4">
  <code >
  &lt;table class="table"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th scope="col"&gt;#&lt;/th&gt;
        &lt;th scope="col"&gt;First&lt;/th&gt;
        &lt;th scope="col"&gt;Last&lt;/th&gt;
        &lt;th scope="col"&gt;Handle&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;1&lt;/td&gt;
        &lt;td&gt;Lucia&lt;/td&gt;
        &lt;td&gt;Christ&lt;/td&gt;
        &lt;td&gt;@Lucia&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;2&lt;/td&gt;
        &lt;td&gt;Catrin&lt;/td&gt;
        &lt;td&gt;Seidl&lt;/td&gt;
        &lt;td&gt;@catrin&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;3&lt;/td&gt;
        &lt;td&gt;Lilli&lt;/td&gt;
        &lt;td&gt;Kirsh&lt;/td&gt;
        &lt;td&gt;@lilli&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;4&lt;/td&gt;
        &lt;td&gt;Else&lt;/td&gt;
        &lt;td&gt;Voigt&lt;/td&gt;
        &lt;td&gt;@voigt&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;5&lt;/td&gt;
        &lt;td&gt;Ursel&lt;/td&gt;
        &lt;td&gt;Harms&lt;/td&gt;
        &lt;td&gt;@ursel&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;6&lt;/td&gt;
        &lt;td&gt;Anke&lt;/td&gt;
        &lt;td&gt;Sauter&lt;/td&gt;
        &lt;td&gt;@Anke&lt;/td&gt;
      &lt;/tr&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;
  </code>
            </pre>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
              </tr>
              <tr>
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
              </tr>
              <tr>
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
              </tr>
              <tr>
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
              </tr>
              <tr>
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
              </tr>
              <tr>
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Bordered Table -->
      <div class="card card-default">
        <div class="card-header">
          <h2>Bordered Table</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-bordered" role="button"
            aria-expanded="false" aria-controls="collapse-table-bordered"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-bordered">
            <pre class="language-html mb-4">
  <code >
  &lt;table class="table table-bordered">
    &lt;thead>
      &lt;tr>
        &lt;th scope="col">#&lt;/th>
        &lt;th scope="col">First&lt;/th>
        &lt;th scope="col">Last&lt;/th>
        &lt;th scope="col">Handle&lt;/th>
        &lt;th class="text-center">Action&lt;/th>
      &lt;/tr>
    &lt;/thead>
    &lt;tbody>
      &lt;tr>
        &lt;td scope="row">1&lt;/td>
        &lt;td>Lucia&lt;/td>
        &lt;td>Christ&lt;/td>
        &lt;td>@Lucia&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
      &lt;tr>
        &lt;td scope="row">2&lt;/td>
        &lt;td>Catrin&lt;/td>
        &lt;td>Seidl&lt;/td>
        &lt;td>@catrin&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
      &lt;tr>
        &lt;td scope="row">3&lt;/td>
        &lt;td>Lilli&lt;/td>
        &lt;td>Kirsh&lt;/td>
        &lt;td>@lilli&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
      &lt;tr>
        &lt;td scope="row">4&lt;/td>
        &lt;td>Else&lt;/td>
        &lt;td>Voigt&lt;/td>
        &lt;td>@voigt&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
      &lt;tr>
        &lt;td scope="row">5&lt;/td>
        &lt;td>Ursel&lt;/td>
        &lt;td>Harms&lt;/td>
        &lt;td>@ursel&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
      &lt;tr>
        &lt;td scope="row">6&lt;/td>
        &lt;td>Anke&lt;/td>
        &lt;td>Sauter&lt;/td>
        &lt;td>@Anke&lt;/td>
        &lt;th class="text-center">
          &lt;a href="#">
            &lt;i class="mdi mdi-open-in-new">&lt;/i>
          &lt;/a>
          &lt;a href="#">
            &lt;i class="mdi mdi-close text-danger">&lt;/i>
          &lt;/a>
  
        &lt;/th>
      &lt;/tr>
    &lt;/tbody>
  &lt;/table>
  </code>
            </pre>
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
              <tr>
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
              <tr>
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
              <tr>
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
              <tr>
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
              <tr>
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
                <th class="text-center">
                  <a href="#">
                    <i class="mdi mdi-open-in-new"></i>
                  </a>
                  <a href="#">
                    <i class="mdi mdi-close text-danger"></i>
                  </a>
  
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Dark Table -->
      <div class="card card-default">
        <div class="card-header">
          <h2>Dark Table</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-dark" role="button"
            aria-expanded="false" aria-controls="collapse-table-dark"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-dark">
            <pre class="language-html mb-4">
  <code >
  &lt;table class="table table-dark"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th scope="col"&gt;#&lt;/th&gt;
        &lt;th scope="col"&gt;First&lt;/th&gt;
        &lt;th scope="col"&gt;Last&lt;/th&gt;
        &lt;th scope="col"&gt;Handle&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;1&lt;/td&gt;
        &lt;td&gt;Lucia&lt;/td&gt;
        &lt;td&gt;Christ&lt;/td&gt;
        &lt;td&gt;@Lucia&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;2&lt;/td&gt;
        &lt;td&gt;Catrin&lt;/td&gt;
        &lt;td&gt;Seidl&lt;/td&gt;
        &lt;td&gt;@catrin&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;3&lt;/td&gt;
        &lt;td&gt;Lilli&lt;/td&gt;
        &lt;td&gt;Kirsh&lt;/td&gt;
        &lt;td&gt;@lilli&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;4&lt;/td&gt;
        &lt;td&gt;Else&lt;/td&gt;
        &lt;td&gt;Voigt&lt;/td&gt;
        &lt;td&gt;@voigt&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;5&lt;/td&gt;
        &lt;td&gt;Ursel&lt;/td&gt;
        &lt;td&gt;Harms&lt;/td&gt;
        &lt;td&gt;@ursel&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;6&lt;/td&gt;
        &lt;td&gt;Anke&lt;/td&gt;
        &lt;td&gt;Sauter&lt;/td&gt;
        &lt;td&gt;@Anke&lt;/td&gt;
      &lt;/tr&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;
  </code>
            </pre>
          </div>
          <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
              </tr>
              <tr>
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
              </tr>
              <tr>
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
              </tr>
              <tr>
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
              </tr>
              <tr>
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
              </tr>
              <tr>
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <!-- Striped Table -->
      <div class="card card-default">
        <div class="card-header">
          <h2>Striped Table</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-striped" role="button"
            aria-expanded="false" aria-controls="collapse-table-striped"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-striped">
            <pre class="language-html mb-4">
  <code >
  &lt;table class="table table-striped"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th scope="col"&gt;#&lt;/th&gt;
        &lt;th scope="col"&gt;First&lt;/th&gt;
        &lt;th scope="col"&gt;Last&lt;/th&gt;
        &lt;th scope="col"&gt;Handle&lt;/th&gt;
        &lt;th scope="col"&gt;Active&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;1&lt;/td&gt;
        &lt;td&gt;Lucia&lt;/td&gt;
        &lt;td&gt;Christ&lt;/td&gt;
        &lt;td&gt;@Lucia&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on" checked&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;2&lt;/td&gt;
        &lt;td&gt;Catrin&lt;/td&gt;
        &lt;td&gt;Seidl&lt;/td&gt;
        &lt;td&gt;@catrin&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on"&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;3&lt;/td&gt;
        &lt;td&gt;Lilli&lt;/td&gt;
        &lt;td&gt;Kirsh&lt;/td&gt;
        &lt;td&gt;@lilli&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on" checked&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;4&lt;/td&gt;
        &lt;td&gt;Else&lt;/td&gt;
        &lt;td&gt;Voigt&lt;/td&gt;
        &lt;td&gt;@voigt&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on"&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;5&lt;/td&gt;
        &lt;td&gt;Ursel&lt;/td&gt;
        &lt;td&gt;Harms&lt;/td&gt;
        &lt;td&gt;@ursel&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on" checked&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;6&lt;/td&gt;
        &lt;td&gt;Anke&lt;/td&gt;
        &lt;td&gt;Sauter&lt;/td&gt;
        &lt;td&gt;@Anke&lt;/td&gt;
        &lt;td&gt;
          &lt;label class="switch switch-primary switch-pill form-control-label "&gt;
            &lt;input type="checkbox" class="switch-input form-check-input" value="on"&gt;
            &lt;span class="switch-label"&gt;&lt;/span&gt;
            &lt;span class="switch-handle"&gt;&lt;/span&gt;
          &lt;/label&gt;
        &lt;/td&gt;
      &lt;/tr&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;
  </code>
            </pre>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th scope="col">Active</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on" checked>
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
              <tr>
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on">
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
              <tr>
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on" checked>
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
              <tr>
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on" >
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
              <tr>
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on" checked>
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
              <tr>
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
                <td>
                  <label class="switch switch-primary switch-pill form-control-label ">
                    <input type="checkbox" class="switch-input form-check-input" value="on">
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                  </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Contextual Table -->
      <div class="card card-default">
        <div class="card-header">
          <h2>Contextual Table</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-contextual" role="button"
            aria-expanded="false" aria-controls="collapse-table-contextual"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-contextual">
            <pre class="language-html mb-4">
  <code >
  &lt;table class="table"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th scope="col"&gt;#&lt;/th&gt;
        &lt;th scope="col"&gt;First&lt;/th&gt;
        &lt;th scope="col"&gt;Last&lt;/th&gt;
        &lt;th scope="col"&gt;Handle&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;td scope="row"&gt;1&lt;/td&gt;
        &lt;td&gt;Lucia&lt;/td&gt;
        &lt;td&gt;Christ&lt;/td&gt;
        &lt;td&gt;@Lucia&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr class="table-primary"&gt;
        &lt;td scope="row"&gt;2&lt;/td&gt;
        &lt;td&gt;Catrin&lt;/td&gt;
        &lt;td&gt;Seidl&lt;/td&gt;
        &lt;td&gt;@catrin&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr class="table-info"&gt;
        &lt;td scope="row"&gt;3&lt;/td&gt;
        &lt;td&gt;Lilli&lt;/td&gt;
        &lt;td&gt;Kirsh&lt;/td&gt;
        &lt;td&gt;@lilli&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr class="table-success"&gt;
        &lt;td scope="row"&gt;4&lt;/td&gt;
        &lt;td&gt;Else&lt;/td&gt;
        &lt;td&gt;Voigt&lt;/td&gt;
        &lt;td&gt;@voigt&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr class="table-danger"&gt;
        &lt;td scope="row"&gt;5&lt;/td&gt;
        &lt;td&gt;Ursel&lt;/td&gt;
        &lt;td&gt;Harms&lt;/td&gt;
        &lt;td&gt;@ursel&lt;/td&gt;
      &lt;/tr&gt;
      &lt;tr class="table-warning"&gt;
        &lt;td scope="row"&gt;6&lt;/td&gt;
        &lt;td&gt;Anke&lt;/td&gt;
        &lt;td&gt;Sauter&lt;/td&gt;
        &lt;td&gt;@Anke&lt;/td&gt;
      &lt;/tr&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;
  </code>
            </pre>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
              </tr>
              <tr class="table-primary">
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
              </tr>
              <tr class="table-info">
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
              </tr>
              <tr class="table-success">
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
              </tr>
              <tr class="table-danger">
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
              </tr>
              <tr class="table-warning">
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
  
      <!-- Table Head States -->
      <div class="card card-default">
        <div class="card-header">
          <h2>Table Head States</h2>
  
          <a class="btn mdi mdi-code-tags" data-toggle="collapse" href="#collapse-table-head-light" role="button"
            aria-expanded="false" aria-controls="collapse-table-head-light"> </a>
  
  
        </div>
        <div class="card-body">
          <div class="collapse" id="collapse-table-head-light">
            <pre class="language-html mb-4">
          <code >
          &lt;table class="table table-dark"&gt;
            &lt;thead&gt;
              &lt;tr&gt;
                &lt;th scope="col"&gt;#&lt;/th&gt;
                &lt;th scope="col"&gt;First&lt;/th&gt;
                &lt;th scope="col"&gt;Last&lt;/th&gt;
                &lt;th scope="col"&gt;Handle&lt;/th&gt;
              &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;1&lt;/td&gt;
                &lt;td&gt;Lucia&lt;/td&gt;
                &lt;td&gt;Christ&lt;/td&gt;
                &lt;td&gt;@Lucia&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;2&lt;/td&gt;
                &lt;td&gt;Catrin&lt;/td&gt;
                &lt;td&gt;Seidl&lt;/td&gt;
                &lt;td&gt;@catrin&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;3&lt;/td&gt;
                &lt;td&gt;Lilli&lt;/td&gt;
                &lt;td&gt;Kirsh&lt;/td&gt;
                &lt;td&gt;@lilli&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;4&lt;/td&gt;
                &lt;td&gt;Else&lt;/td&gt;
                &lt;td&gt;Voigt&lt;/td&gt;
                &lt;td&gt;@voigt&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;5&lt;/td&gt;
                &lt;td&gt;Ursel&lt;/td&gt;
                &lt;td&gt;Harms&lt;/td&gt;
                &lt;td&gt;@ursel&lt;/td&gt;
              &lt;/tr&gt;
              &lt;tr&gt;
                &lt;td scope="row"&gt;6&lt;/td&gt;
                &lt;td&gt;Anke&lt;/td&gt;
                &lt;td&gt;Sauter&lt;/td&gt;
                &lt;td&gt;@Anke&lt;/td&gt;
              &lt;/tr&gt;
            &lt;/tbody&gt;
          &lt;/table&gt;
          </code>
                    </pre>
          </div>
          <table class="table ">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">1</td>
                <td>Lucia</td>
                <td>Christ</td>
                <td>@Lucia</td>
              </tr>
              <tr>
                <td scope="row">2</td>
                <td>Catrin</td>
                <td>Seidl</td>
                <td>@catrin</td>
              </tr>
              <tr>
                <td scope="row">3</td>
                <td>Lilli</td>
                <td>Kirsh</td>
                <td>@lilli</td>
              </tr>
              <tr>
                <td scope="row">4</td>
                <td>Else</td>
                <td>Voigt</td>
                <td>@voigt</td>
              </tr>
              <tr>
                <td scope="row">5</td>
                <td>Ursel</td>
                <td>Harms</td>
                <td>@ursel</td>
              </tr>
              <tr>
                <td scope="row">6</td>
                <td>Anke</td>
                <td>Sauter</td>
                <td>@Anke</td>
              </tr>
            </tbody>
          </table>
            </div>
        </div>
        </div>
    
    </div>
    </div>
 </div>
          
         
  
@endsection

@section('scripts')
    
@endsection