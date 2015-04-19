<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Push</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding-top    : 20px;
            padding-bottom : 20px;
        }
    </style>
</head>
<body ng-app="app">

<div class="container" ng-controller="MessagesCtrl as ctrl">
    <div class="row">
        <div class="col-sm-8">
            <ul class="list-group">
                <li class="list-group-item" ng-repeat="message in ctrl.messages | orderBy:'-id'">
                    <strong class="list-group-item-heading">{{message.author}}</strong>

                    <p class="list-group-item-text">{{message.content}}</p>
                </li>
            </ul>
        </div>
        <div class="col-sm-4">
            <form name="messageForm">
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" placeholder="John" ng-model="ctrl.form.author"
                           required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" rows="3" id="content" placeholder="Hello how are you ?"
                              ng-model="ctrl.form.content" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" ng-disabled="messageForm.$invalid"
                        ng-click="ctrl.submitForm(ctrl.form)">Submit
                </button>
            </form>
        </div>
    </div>

</div>
<!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
<script src="node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
<script src="scripts/controllers/messages.js"></script>
</body>
</html>
