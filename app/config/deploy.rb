set :application, "Piggybox"
set :domain,      "http://ks220446.kimsufi.com"
set :deploy_to,   "/var/www/Piggybox"
set :app_path,    "app"

set :scm,         :git
set :repository,  "git@github.com:dupuchba/PiggiBox.git"
git@github.com:dupuchba/PiggiBox.git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, `subversion` or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Rails migrations will run

set  :keep_releases,  3