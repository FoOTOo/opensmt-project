OpenSMT Install Guide（Draft）

1.Install the following packages:

> $ pfexec pkg install webstack-ui

> $ pfexec pkg install SUNWsmba

> $ pfexec pkg install SUNWexpect

> $ pfexec pkg install SUNWrsync

> Install iscsi and restart your computer to make iscsi service work.
> > $ pfexec pkg install storage-server SUNWiscsit.

2. Copy file openSMT/httpd.conf to /etc/apache2/2.2/httpd.conf to overlap orginal apache configurations.

3. Copy openSMT/rsyncd.conf-example to /etc/ and rename it to rsyncd.conf

4. Copy openSMT/ to /var/apache2/2.2/htdocs and change the authority to 777(type command: chmod -R 777 /var/apache2/2.2/htdocs/opensmt). The reason why we must change the authority of opensmt to 777 is that we need to have the authority to execute some commands such as modifying the configuration file of some services.

5. Change the authority of these configuration directories to 777. The reason is as step four.

> $ pfexec chmod -R 777 /etc/sfw

> $ pfexec chmod -R 777 /etc/ftpd

> $ pfexec chmod -R 777 /etc/apache2/2.2

> $ pfexec chmod -R 777 /etc/default

> $ pfexec chmod -R 777 /etc/ssh

> $ pfexec chmod -R 777 /etc/rsyncd.conf

6. Copy openSMT/passwd.sh to /usr/local/bin

7. Execute the following command:
> $ pfexec usermod -P 'Primary Administrator' webservd

8. Restart http service.
> command: svcadm restart apache22

9. Open a browser and visit http://localhost/site/