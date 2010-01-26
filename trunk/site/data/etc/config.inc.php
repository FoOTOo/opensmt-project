;<?php exit();?>
[system]
char = 'utf-8';
time = '+8';
debug = d11;
[db]
mysql.username  = root
mysql.password  = root
mysql.chars     = utf-8
mysql.dbname    = zhiwen
[controller]
defaultModuleName = defaultModule
defaultControllerName = defaultController
defaultActionName = defaultAction
options.userController.Path = /var/apache2/2.2/htdocs/opensmt/trunk/site/usr/
options.userController.Map = map.php
;options.userController.FileExt = .so
;options.userController.FileRule =\\1\\0controller\\0\\2
options.userController.FileRule =\\1Module\\0controller\\0\\2Controller@\\1\\0controller\\0\\2Controller@\\1Module\\0controller\\0\\2@\\1\\0controller\\0\\2@
options.userController.ClassRule =\\2
;options.userController.MethodRule =\\1\\0\\2\\
options.userController.MapRule = \\1\\0etc\\0\\2

[view]

className = Smarty_View
template.test = t22
template.path = ./view/
template.cache = ./data/cache/view/cache/
template.compile = ./data/cache/view/compile/
template.name = wp
template.baseUrl = /site/view/wp/
[adminmenu]
;id是用来在模板中进行各种判断所需要信息
Status.id = status
Status.desc = Status
Status.current = status
Status.open = status
Status.sub.system.text = system
Status.sub.system.href = /status/system
Status.sub.system.action = system
Status.sub.process.text = process
Status.sub.process.href = /status/process
Status.sub.process.action = process

Status.sub.interfaces.text = interfaces
Status.sub.interfaces.href = /status/interfaces
Status.sub.interfaces.action = interfaces



Disk.id = Disk
Disk.desc  = Disk
Disk.current = Disk
Disk.open = Disk

Disk.sub.diskinfo.text = diskinfo
Disk.sub.diskinfo.href = /disk/diskinfo
Disk.sub.diskinfo.action = diskinfo

Disk.sub.zpoolinfo.text = zpoolinfo
Disk.sub.zpoolinfo.href = /disk/zpool/default
Disk.sub.zpoolinfo.action = zpoolinfo

Disk.sub.zpoolcreate.text = zpoolcreate
Disk.sub.zpoolcreate.href = /disk/zpool/zpoolcreate
Disk.sub.zpoolcreate.action = zpoolcreate

Disk.sub.zpoolop.text = zpoolop
Disk.sub.zpoolop.href = /disk/zpool/zpoolop
Disk.sub.zpoolop.action = zpoolop

Disk.sub.zpoolio.text = zpoolio
Disk.sub.zpoolio.href = /disk/zpool/zpoolio
Disk.sub.zpoolio.action = zpoolio

zfs.id = zfs
zfs.desc = ZFS
zfs.current = zfs
zfs.open = zfs

zfs.sub.zfsinfo.text = zfsinfo
zfs.sub.zfsinfo.href = /zfs/zfs/zfsinfo
zfs.sub.zfsinfo.action = zfsinfo

zfs.sub.zfscreate.text = zfscreate
zfs.sub.zfscreate.href = /zfs/zfs/zfscreate
zfs.sub.zfscreate.action = zfscreate

zfs.sub.zfsmanage.text = zfsmanage
zfs.sub.zfsmanage.href = /zfs/zfs/zfsmanage
zfs.sub.zfsmanage.action = zfsmanage

;zfs.sub.zfsedit.href = /zfs/default/zfsedit
zfs.sub.zfsmanage.action = zfsedit

zfs.sub.zfsquery.text = zfsquery
zfs.sub.zfsquery.href = /zfs/zfs/zfsquery
zfs.sub.zfsquery.action = zfsquery

zfs.sub.zfssnapshot.text = zfssnapshot
zfs.sub.zfssnapshot.href = /zfs/zfs/zfssnapshot
zfs.sub.zfssnapshot.action = zfssnapshot

service.id = service
service.desc  = Service
service.current = service
service.open = service
service.sub.status.text = Status
service.sub.status.href = /service/status/
service.sub.status.action = status
service.sub.ftpmanagement.text = FTP
service.sub.ftpmanagement.href = /service/default/ftpmanagement
service.sub.ftpmanagement.action = ftpmanagement
service.sub.sshmanagement.text = SSH
service.sub.sshmanagement.href = /service/default/sshmanagement
service.sub.sshmanagement.action = sshmanagement
service.sub.smbmanagement.text = CIFS/SMB
service.sub.smbmanagement.href = /service/default/smbmanagement
service.sub.smbmanagement.action = smbmanagement
service.sub.nfsmanagement.text = NFS
service.sub.nfsmanagement.href = /service/default/nfsmanagement
service.sub.nfsmanagement.action = nfsmanagement
service.sub.httpmanagement.text = Webserver
service.sub.httpmanagement.href = /service/default/httpmanagement
service.sub.httpmanagement.action = httpmanagement
service.sub.rsyncmanagement.text = Rsync
service.sub.rsyncmanagement.href = /service/default/rsyncmanagement
service.sub.rsyncmanagement.action = rsyncmanagement

Share.id = Share
Share.desc = Share
Share.current = Share
Share.open = Share
Share.sub.samba.text = CIFS/SMB
Share.sub.samba.href = /share/default/samba
Share.sub.samba.action = samba
;Share.sub.sambaEdit.href = /share/default/editsamba
;.sub.sambaEdit.action = editsamba
Share.sub.nfs.text = NFS
Share.sub.nfs.href = /share/default/nfs
Share.sub.nfs.action = nfs
;Share.sub.nfsEdit.href = /share/default/editnfs
;Share.sub.nfsEdit.action = editnfs
Share.sub.rsync.text = Rsync
Share.sub.rsync.href = /share/rsync/default
Share.sub.rsync.action = rsync

iSCSI.id = iSCSI
iSCSI.desc = iSCSI
iSCSI.current = iSCSI
iSCSI.open = iSCSI

iSCSI.sub.lun.text = LUN
iSCSI.sub.lun.href = /iSCSI/LUN/default
iSCSI.sub.lun.action = lun

iSCSI.sub.target.text = target
iSCSI.sub.target.href = /iSCSI/target/default
iSCSI.sub.target.action = target

iSCSI.sub.group.text = group
iSCSI.sub.group.href = /iSCSI/group/default
iSCSI.sub.group.action = iscsigroup

Access.id = access
Access.desc  = Access
Access.current = access
Access.open = access

Access.sub.user.text = user
Access.sub.user.href = /access/default/user
Access.sub.user.action = user

Access.sub.group.text = group
Access.sub.group.href = /access/default/group
Access.sub.group.action = group

;Access.sub.edituser.text = edituser
;Access.sub.edituser.action = edituser
;Access.sub.edituser.href = /access/default/edituser

;Access.sub.editgroup.text = editgroup
;Access.sub.editgroup.href = /access/default/editgroup
;Access.sub.editgroup.action = editgroup






Diagnostics.id = diagnostics
Diagnostics.desc  = Diagnostics
Diagnostics.current = diagnostics
Diagnostics.open = diagnostics

Diagnostics.sub.ping.text = ping
Diagnostics.sub.ping.href = /diagnostics/default/ping
Diagnostics.sub.ping.action = ping

Diagnostics.sub.traceroute.text = Traceroute
Diagnostics.sub.traceroute.href = /diagnostics/default/traceroute
Diagnostics.sub.traceroute.action = traceroute

Diagnostics.sub.Dmesg.text = Dmesg
Diagnostics.sub.Dmesg.href = /Diagnostics/Dmesg/
Diagnostics.sub.Dmesg.action = Dmesg

Diagnostics.sub.Route.text = Route
Diagnostics.sub.Route.href = /Diagnostics/Route/
Diagnostics.sub.Route.action = Route

Diagnostics.sub.ARPTable.text =  ARPTable
Diagnostics.sub.ARPTable.href = /Diagnostics/ARPTable/
Diagnostics.sub.ARPTable.action = ARPTable

Diagnostics.sub.Modules.text = Modules
Diagnostics.sub.Modules.href = /Diagnostics/Modules/
Diagnostics.sub.Modules.action = Modules

Diagnostics.sub.SystemInformation.text = SystemInformation
Diagnostics.sub.SystemInformation.href = /Diagnostics/SystemInformation/
Diagnostics.sub.SystemInformation.action = SystemInformation

system.id = System
system.desc = System
system.current = System
system.open = System
system.sub.reboot.text = Reboot
system.sub.reboot.href = /system/default/reboot
system.sub.reboot.action = reboot
system.sub.shutdown.text = Shutdown
system.sub.shutdown.href = /system/default/shutdown
system.sub.shutdown.action = shutdown
system.sub.dns.text = DNS
system.sub.dns.href = /system/dns/
system.sub.dns.action = dns
system.sub.date.text = Date
system.sub.date.href = /system/date
system.sub.date.action = date
system.sub.lan.text = LAN
system.sub.lan.href = /system/lan
system.sub.lan.action = lan

Help.id = help
Help.desc = Help
Help.current = help
Help.open = help
Help.sub.license.text = License
Help.sub.license.href = /help/default/license
Help.sub.license.action = license
Help.sub.release.text = Release Notes
Help.sub.release.href = /help/default/release
Help.sub.release.action = release


;test.id = test
;test.desc = test
;test.current = test
;test.open = test
;链接是的文字描述
;test.sub.test1.text = text1
;链接的地址
;test.sub.test1.href =  /test/test/test1/
;链接的样式控制参数,是来处理开启样式
;test.sub.test1.action = test1

;test.sub.test2.text = text1
;test.sub.test2.href =  /test/test/test1/
;test.sub.test2.action = test1

;test.sub.test3.text = text1
;test.sub.test3.href =  /test/test/test1/
;test.sub.test3.action = test1

;test.sub.test4.text = text1
;test.sub.test4.href =  /test/test/test1/
;test.sub.test4.action = test1

;test.sub.test5.text = text1
;test.sub.test5.href =  /test/test/test1/
;test.sub.test5.action = test1

;test1.id = test2
;test1.desc =test2
//open控制菜单是否缺省展开,此值与id相等时即可开启子菜单
;test1.open = test2

;test1.sub.test1.text = text1
;test1.sub.test1.href =  /test/test/test1/
;test1.sub.test1.action = test1

;test1.sub.test2.text = text1
;test1.sub.test2.href =  /test/test/test1/
;test1.sub.test2.action = test1

;test1.sub.test3.text = text1
;test1.sub.test3.href =  /test/test/test1/
;test1.sub.test3.action = test1

;test1.sub.test4.text = text1
;test1.sub.test4.href =  /test/test/test1/
;test1.sub.test4.action = test1

;test1.sub.test5.text = text1
;test1.sub.test5.href =  /test/test/test1/
;test1.sub.test5.action = test1
