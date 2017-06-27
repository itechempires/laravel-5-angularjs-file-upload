<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 5 AngularJS File Upload</title>

    {{-- Application CSS File --}}
    <link rel="stylesheet" href="css/app.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body ng-app="App">

<div ng-controller="FileUploadController">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Laravel 5 AngularJS File Upload Demo</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="files">Select Image File</label>
                    <input type="file" ng-files="setTheFiles($files)" id="image_file"  class="form-control">
                </div>

                <ul class="alert alert-danger" ng-if="errors.length > 0">
                    <li ng-repeat="error in errors">
                        @{{ error }}
                    </li>
                </ul>

                <div class="form-group">
                    <button ng-click="uploadFile()" class="btn btn-primary">Upload File</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4>Uploaded Files</h4>
                <table ng-if="files.length > 0" class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Type</th>
                        <th>Uploaded On</th>
                        <th>Delete</th>
                    </tr>
                    <tr ng-repeat="file in files">
                        <td>@{{ $index + 1 }}</td>
                        <td>@{{ file.name }}</td>
                        <td>@{{ file.size }}</td>
                        <td>@{{ file.type }}</td>
                        <th>
                            @{{ file.created_at }}
                        </th>
                        <td>
                            <button ng-click="deleteFile($index)" class="btn btn-danger">Delete File</button>
                        </td>
                    </tr>
                </table>
                <div class="alert alert-success" ng-if="files.length == 0">
                    Files not found, please upload to test the demo application.
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Application JS Files --}}
<script src="js/app.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>