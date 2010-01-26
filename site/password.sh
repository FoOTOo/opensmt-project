#!/usr/bin/expect
if {$argc<2} {
	send_user "usage: $argv0 username password\n"
	exit
}
				   
set username [lindex $argv 0]
set password [lindex $argv 1]
								 
spawn -noecho pfexec passwd [lindex $argv 0]      
expect	"New Password:"        {send "$password\n"}
expect	"Re-enter new Password:"        {send "$password\n"}

expect "*word*"
expect eof
exit
#=========END=======================================================
