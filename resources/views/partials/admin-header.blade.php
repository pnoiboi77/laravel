<nav class="navbar navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('blog.index') }}">Home</a></li>
            <li><a href="{{ route('admin.index') }}">Admin</a></li>
            <li><a href="{{ route('admin.create') }}">Add Post</a></li>
            <li><a href="{{ route('other.about') }}">About</a></li>            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>