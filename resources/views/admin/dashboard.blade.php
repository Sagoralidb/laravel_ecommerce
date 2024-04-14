@extends('layouts.admin')

@section('title','Admin Dashboad')

@section('css')
    
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">                
      <div class="row">
            <div class="col-lg-12">
              <div class="card card-default text-dark">
                <div class="card-header">
                  <h1 class="mb-3">Introduction</h1>
                  <p style="text-transform:none">Thank you for purchasing Mono dashboard, a fully featured admin template and UI kit built on top of awesome Bootstrap 4. It is a very useful bootstrap admin dashboard, which allows you to build products like admin panels, content managements systems and CRMs. It is fully responsive and easily customizable. Its UI elements can be used very easily on any page.</p>
                </div>

                <div class="card-body pt-4">
                  <h2 class="mt-2 mb-2">Getting Started</h2>
                  <p> This documentation will give you an understanding of how <strong>Mono Dashboard</strong> is structured and guide you in performing common functions. If you require further assistance not covered in this documentation, please contact me at <a href="mailto:theme@iamabdus.com">theme@iamabdus.com</a></p>

                </div>

                <div class="card-body pt-4">
                  <h2 class="mt-2 mb-2">Set up</h2>
                  <p class="mb-1">Mono uses gulp for workflow automation. It's a toolkit for automating painful or time-consuming tasks in your development workflow, so you can stop messing around and build something. </p><br><br>
                  <p class="mb-1">
                    <strong>Step-1:</strong> Make sure you have a recent version of <a target="_blank"
                      href="https://nodejs.org/en/">Node.js</a> installed in your local machine.
                  </p>
                  <p class="mb-1">
                    <strong>Step-2:</strong> Open <strong>terminal</strong> in the project root directory.
                  </p>
                  <p class="mb-4">
                    <strong>Step-3:</strong> Then run the following commands accordingly into terminal:
     
                  <pre class="language-javascript">
                  //install gulp-cli globally
                  $ npm install gulp-cli -g

                  //install devDependencies
                  $ npm install

                  //run project
                  $ gulp
                  </pre>
                  <br>

                    This will fire default gulp task which includes: launching BrowserSync, build all html files, javascript
                    minification, sass compilation and lanching watch task. BrowserSync will create dev server and sync your browser
                    with your code editor.
                  </p>
                  <p class="mt-2">
                    You are all done to edit SCSS files and gulp will compile your SCSS to CSS.
                  </p>

                </div>

                <div class="card-body pt-4">
                  <h2 class="mt-2 mb-5">File Structure</h2>
                    <ul>
                      <li>
                        <strong> <i class="mdi mdi-folder text-warning"></i> dist</strong>
                      </li>
                      <li>
                        <strong><i class="mdi mdi-folder text-warning"></i> node_modules</strong>
                      </li>
                      <li>
                        <strong><i class="mdi mdi-folder text-warning"></i> src</strong>
                        <ul class="ml-6">
                          <li>
                            <strong><i class="mdi mdi-folder text-warning"></i> assets</strong>
                            <ul class="ml-5">
                              <li>
                                <strong><i class="mdi mdi-folder text-warning"></i> img</strong>
                              </li>
                              <li>
                                <strong><i class="mdi mdi-folder text-warning"></i> js</strong>
                              </li>
                              <li>
                                <strong><i class="mdi mdi-folder text-warning"></i> plugins </strong>
                              </li>
                              <li>
                                <strong><i class="mdi mdi-folder text-warning"></i> scss</strong>
                              </li>
                            </ul>
                          </li>
                          <li>
                            <strong><i class="mdi mdi-file-document text-color"></i> index.html</strong>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <strong><i class="mdi mdi-file-document text-color"></i> gulpfile.js</strong>
                      </li>
                      <li>
                        <strong><i class="mdi mdi-file-document text-color"></i> package.json</strong>
                      </li>
                      <li>
                        <strong><i class="mdi mdi-file-document text-color"></i> .gitignore</strong>
                      </li>
                    </ul>

                </div>

                <!-- Button -->
                <div class="d-flex justify-content-end pb-6 px-6">

                  <a href="navbar-customization.html" class="btn btn-primary btn-pill">navbar customization
                    <i class="mdi mdi-arrow-right"></i>
                  </a>

                </div>
              </div>
            </div>

          </div>
      </div>
          
  </div>
@endsection

@section('scripts')
    
@endsection