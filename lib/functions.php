<?php

function rmRecursive ($path){

	$path = realpath($path);
    if(!file_exists($path))
        throw new RuntimeException('Fichier ou dossier non-trouvé');
    if(is_dir($path)) {
        $dir = scandir($path, SCANDIR_SORT_DESCENDING);
        foreach($dir as $file_in_dir){
            if($file_in_dir == '.' or $file_in_dir == '..')
                break; // on sort de boucle : il n'y aura rien d'autre
            rmRecursive("$path/$file_in_dir");
        }
    }
    if(is_dir($path)){
	    rmdir($path);
    } else {
	    unlink($path);
    }
}

function smartCopy($source, $dest, $options=array('folderPermission'=>0755,'filePermission'=>0755)) {
 
    $result=false; 
    
    if (is_file($source)) { 
        if ($dest[strlen($dest)-1]=='/') { 
            if (!file_exists($dest)) { 
                cmfcDirectory::makeAll($dest,$options['folderPermission'],true); 
            } 
            $__dest=$dest."/".basename($source); 
        } else { 
            $__dest=$dest; 
        } 
        $result=copy($source, $__dest); 
        chmod($__dest,$options['filePermission']); 
        
    } elseif(is_dir($source)) { 
        if ($dest[strlen($dest)-1]=='/') { 
            if ($source[strlen($source)-1]=='/') { 
                //Copy only contents 
            } else { 
                //Change parent itself and its contents 
                $dest=$dest.basename($source); 
                @mkdir($dest); 
                chmod($dest,$options['filePermission']); 
            } 
        } else { 
            if ($source[strlen($source)-1]=='/') { 
                //Copy parent directory with new name and all its content 
                @mkdir($dest,$options['folderPermission']); 
                chmod($dest,$options['filePermission']); 
            } else { 
                //Copy parent directory with new name and all its content 
                @mkdir($dest,$options['folderPermission']); 
                chmod($dest,$options['filePermission']); 
            } 
        } 

        $dirHandle=opendir($source); 
        while($file=readdir($dirHandle)) 
        { 
            if($file!="." && $file!="..") 
            { 
                 if(!is_dir($source."/".$file)) { 
                    $__dest=$dest."/".$file; 
                } else { 
                    $__dest=$dest."/".$file; 
                } 
                //echo "$source/$file ||| $__dest<br />"; 
                $result=smartCopy($source."/".$file, $__dest, $options); 
            } 
        } 
        closedir($dirHandle); 
        
    } else { 
        $result=false; 
    } 
    return $result; 
}
?>