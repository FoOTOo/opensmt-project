use File::Find;  
use File::Path;  
   
find( sub { rmtree($_, 1, 1) if (-d $_ and $_ eq '.svn');}, '.');  
