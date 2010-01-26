<?php /* Smarty version 2.6.26, created on 2010-01-01 21:36:53
         compiled from element/systeminformation.html */ ?>

<div class="admin-panel-wrap">
    <div class=" icon-link-manager icon32">
        <br/>
    </div>
    <h2>systeminformation</h2>
    <div class="metabox-holder poststuff">
        <form method="post" action="post.php" onsubmit="return false;">
            <div class="postbox">
                        <div class="handlediv" title="显示/隐藏">
                            <br/>
                        </div>
                        <h3 class="hndle">
                            <span>systeminformation</span>
                        </h3>
                        <div class="inside">
                            <div class="inside-body">
                                <div>
                                    <input class="button-secondary action doaction" type="submit" value="Hardware" id="hardware"/>
                                    <input class="button-secondary action doaction" type="submit" value="Pool" id="pool"/>
                                    <input class="button-secondary action doaction" type="submit" value="Space Used" id="spaceused"/>
                                    <input class="button-secondary action doaction" type="submit" value="Mounts" id="mounts"/>
                                    <input class="button-secondary action doaction" type="submit" value="NFS" id="nfs"/>
                                    <input class="button-secondary action doaction" type="submit" value="Sockets" id="sockets"/>
                                    <input class="button-secondary action doaction" type="submit" value="Swap" id="swap"/>
                                    <input class="button-secondary action doaction" type="submit" value="SMART" id="smart"/>
                                    <input class="button-secondary action doaction" type="submit" value="iSCSI Initiator" id="iscsi"/>
                                    <input class="button-secondary action doaction" type="submit" value="RSYNC" id="rsyns"/>
                                    <input class="button-secondary action doaction" type="submit" value="RAID" id="raid"/>
                                    <input class="button-secondary action doaction" type="submit" value="CIFS/SMB" id="cifs_smb"/>
                                    <input class="button-secondary action doaction" type="submit" value="FTP" id="ftp"/>
                                </div>
                                <div >
                                    <pre class="updated" id="systemInfoText"><?php echo $this->_tpl_vars['systemInfoText']; ?>
</pre>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="clear"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function infoload(url) {
        var myHTMLRequest = new Request.HTML({
            onComplete: function(responseTree, responseElements, responseHTML, responseJavaScript){
                $('systemInfoText').set('html',responseHTML);
            }
        }).get('<?php echo $this->_tpl_vars['webUrl']; ?>
'+ url);
    }
    $('hardware').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/hardware/';
        infoload(url);
        return false;
    })
    $('pool').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/pool/';
        infoload(url);
        return false;
    })
    $('spaceused').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/spaceused/';
        infoload(url);
        return false;
    })
    $('mounts').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/mounts/';
        infoload(url);
        return false;
    })
    $('nfs').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/nfs/';
        infoload(url);
        return false;
    })
    $('sockets').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/sockets/';
        infoload(url);
        return false;
    })
    $('swap').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/swap/';
        infoload(url);
        return false;
    })
    $('smart').addEvent('click',function(){
        alert('not data')
        return false;
    })
    $('iscsi').addEvent('click',function(){
        alert('not data')
        return false;
    })
    $('rsyns').addEvent('click',function(){
        alert('not data')
        return false;
    })
    $('raid').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/raid/';
        infoload(url);
        return false;
    })
    $('cifs_smb').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/cifssmb/';
        infoload(url);
        return false;
    })
    $('ftp').addEvent('click',function(){
        var url = '/Diagnostics/systeminformation/ftp/';
        infoload(url);
        return false;
    })
</script>