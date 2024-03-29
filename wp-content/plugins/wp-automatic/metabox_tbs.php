<?php

// Globals
global $post;
global $wpdb;
global $camp_general;
global $post_id;
global $camp_options;
global $post_types;

global $camp_post_category;

global $camp_translate_from;
global $camp_translate_to;
global $camp_translate_to_2;

?>

<div class="TTWForm-container" dir="ltr">
	<div class="TTWForm">
		<div class="panes">
		
			 <div id="field1zz-container" class="field f_100">
               <div class="option clearfix">
                    <input data-controls="wp_automatic_spin_title" name="camp_options[]" id="field2-1" value="OPT_TBS" type="checkbox">
                    <span class="option-title">
							Spin Posted Content using "the best spinner" <i>(require the best spinner account)</i> 
                    </span>
                    <br>
               </div>
               
               <div id="wp_automatic_spin_title"  class="field f_100">
               
	               	<div class="option clearfix">
	                    <input name="camp_options[]" id="field2-1" value="OPT_TBS_TTL" type="checkbox">
	                    <span class="option-title">
								Don't spin the title 
	                    </span>
	                    <br>
	               </div>
               
               </div>
               
		 	</div>
		
		
			<div id="translate_post" class="field f_100">
               <div class="option clearfix">
                    
                    <?php 
                    
	                    
	                    // Microsoft langues and langauges codes 
	                    $langs = explode(',',"---,Arabic,Bosnian (Latin),Bulgarian,Catalan,Chinese Simplified,Chinese Traditional,Croatian,Czech,Danish,Dutch,English,Estonian,Finnish,French,German,Greek,Haitian Creole,Hebrew,Hindi,Hmong Daw,Hungarian,Indonesian,Italian,Japanese,Kiswahili,Klingon,Klingon (pIqaD),Korean,Latvian,Lithuanian,Malay,Maltese,Norwegian,Persian,Polish,Portuguese,QuerÃ©taro Otomi,Romanian,Russian,Serbian (Cyrillic),Serbian (Latin),Slovak,Slovenian,Spanish,Swedish,Thai,Turkish,Ukrainian,Urdu,Vietnamese,Welsh,Yucatec Maya" );
	                    $langs_c = explode(',', "no,ar,bs-Latn,bg,ca,zh-CHS,zh-CHT,hr,cs,da,nl,en,et,fi,fr,de,el,ht,he,hi,mww,hu,id,it,ja,sw,tlh,tlh-Qaak,ko,lv,lt,ms,mt,nor,fa,pl,pt,otq,ro,ru,sr-Cyrl,sr-Latn,sk,sl,es,sv,th,tr,uk,ur,vi,cy,yua");
	                    
	                    // Google languages and languages codes
	                    $g_langs=array("---","Auto-Detect","Afrikaans","Albanian","Arabic","Armenian","Belarusian","Bulgarian","Catalan","Chinese","Croatian","Czech","Danish","Dutch","English","Estonian","Filipino","Finnish","French","Galician","German","Greek","Hebrew","Hindi","Hungarian","Icelandic","Indonesian","Irish","Italian","Japanese","Korean","Latvian","Lithuanian","Macedonian","Malay","Maltese","Persian","Polish","Portuguese","Romanian","Russian","Serbian","Slovak","Slovenian","Spanish","Swahili","Swedish","Thai","Turkish","Ukrainian","Vietnamese","Welsh","Yiddish","Norwegian");
	                    $g_langs_c=array("no","auto","af","sq","ar","hy","be","bg","ca","zh-CN","hr","cs","da","nl","en","et","tl","fi","fr","gl","de","el","iw","hi","hu","is","id","ga","it","ja","ko","lv","lt","mk","ms","mt","fa","pl","pt","ro","ru","sr","sk","sl","es","sw","sv","th","tr","uk","vi","cy","yi","nor");
                    	
	                    
                    ?>
                    
                    <input name="camp_options[]" id="translate_option" value="OPT_TRANSLATE" type="checkbox">
                    <span class="option-title">
							Translate the post before posting (using Microsoft Translator/Google Translate)
        				</span>
                    <br>
                    
                    
		            <div id="translate_c" class="field f_100">
		            
		            
		            <div id="field1zz-container" class="field f_100">
			               <label>
			                    Translator:
			               </label>
			               <select name="cg_translate_method"  data-filters=".wp_automatic_lang_select" >
			                    <option value="microsoftTranslator"  <?php @wp_automatic_opt_selected('microsoftTranslator',$camp_general['cg_translate_method']) ?> >
			                         Microsoft Translator
			                    </option>
			                    <option  value="googleTranslator"  <?php @wp_automatic_opt_selected( 'googleTranslator' , $camp_general['cg_translate_method'] ) ?>  >
			                         Google Translator
			                    </option> 
			                    
			                    
			               </select>
			          </div>
		            
		               From  
		                
		               	<select name="camp_translate_from" class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
		               		 <?php
							 
		               		 // Microsoft Languages output.
		               		 $i=0; 
		               		 
		               		 foreach($langs as $lang){
		               		 	?>
		               		 	  
		               		 	  <option data-filter-val="microsoftTranslator"   value="<?php   echo $langs_c[$i] ?>"  
		               		 	  <?php 
		               		 	  
		               		 	  if( $camp_general['cg_translate_method'] == 'microsoftTranslator')
		               		 	  { 
		               		 	  	@wp_automatic_opt_selected($langs_c[$i],$camp_translate_from); 
		               		 	  } 
		               		 	  
		               		 	  ?> ><?php   echo $langs[$i]?></option>
		               		 		 
		               		 	<?php
		               		 	
								$i++;
		               		 }
		               		 
		               		 // Google Languages output.
		               		 $i=0;
		               		 foreach($g_langs as $lang){
		               		 	?>
		               		 		               		 	  
               		 		        <option data-filter-val="googleTranslator"   value="<?php   echo $g_langs_c[$i] ?>"  
               		 		        <?php 
               		 		        
               		 		        if( $camp_general['cg_translate_method'] == 'googleTranslator') {
               		 		        	@wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_from);
               		 		        } ?> ><?php   echo $g_langs[$i]?></option>
               		 		               		 		 
               		 		       <?php
               		 		               		 	
               		 			   $i++;
               		 		  }
		               		 
		               		 ?>
		               	</select>
		               		 
		               		 To	<select name="camp_translate_to"  class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
			               		 
			               		 <?php
			               		  
								$i=0;
			               		 foreach($langs as $lang){
			               		 	?>
			               		 	
			               		 		<option  data-filter-val="microsoftTranslator"  value="<?php   echo $langs_c[$i] ?>"  <?php if( $camp_general['cg_translate_method'] == 'microsoftTranslator') @wp_automatic_opt_selected($langs_c[$i],$camp_translate_to) ?> ><?php   echo $langs[$i]?></option>
			               		 	
			               		 	<?php 
									$i++;
			               		 }
			               		 
			               		 // Google Languages output.
			               		 $i=0;
			               		 foreach($g_langs as $lang){
			               		 	?>
			               		 		               		 		               		 	  
               		                <option data-filter-val="googleTranslator"   value="<?php   echo $g_langs_c[$i] ?>"  <?php  if( $camp_general['cg_translate_method'] == 'googleTranslator') @wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_to) ?> ><?php   echo $g_langs[$i]?></option>
               		                		 		               		 		 
               		                <?php
               		                		 		               		 	
               		                  $i++;
               		               }
			               		 
			               		 ?>
			               		 
		               	
		               		</select>
		               		
		               		To	<select name="camp_translate_to_2"  class="wp_automatic_lang_select translate_t" style="width:25%;padding:0;">
		               		 
			               		 
			               		 <?php
			               		  
			               		 	// Microsoft Languages output.
									$i=0;
				               		foreach($langs as $lang){
				               		 	?>
				               		 	
				               		 		<option   data-filter-val="microsoftTranslator"  value="<?php   echo $langs_c[$i] ?>"  <?php if( $camp_general['cg_translate_method'] == 'microsoftTranslator') @wp_automatic_opt_selected($langs_c[$i],$camp_translate_to_2) ?> ><?php   echo $langs[$i]?></option>
				               		 	
				               		 	<?php 
										$i++;
				               		}
									
									// Google Languages output.
									$i=0;
									foreach($g_langs as $lang){
									
									?>
												               		 		               		 		               		 	  
               		                <option data-filter-val="googleTranslator"   value="<?php   echo $g_langs_c[$i] ?>"  <?php  if( $camp_general['cg_translate_method'] == 'googleTranslator') @wp_automatic_opt_selected($g_langs_c[$i],$camp_translate_to_2) ?> ><?php   echo $g_langs[$i]?></option>
               		                		 		               		 		 
               		                <?php
               		                		 		               		 	
               		                  $i++;
               		                }
																		
			               		 
			               		 
			               		 ?>
			               		 
		               	
		               		</select>
		                	
		                	
		                	         <div id="field1zzxzx-container" class="field f_100">
							               <div class="option clearfix">
							                    <input name="camp_options[]" id="field2xzx-1" value="OPT_TRANSLATE_TITLE" type="checkbox">
							                    <span class="option-title">
														Translate title also   
							                    </span>
							                    <br>
							               </div>
							               
							               <div class="option clearfix">
							                    <input name="camp_options[]"  value="OPT_TRANSLATE_FTP" type="checkbox">
							                    <span class="option-title">
														If translation got failed set the post status to Pending   
							                    </span>
							                    <br>
							               </div>
							               
									 </div>
		                	
		            </div>
		            
               </div>
		 </div><!-- translation -->
		 
		 
		 <div  class="field f_100">
               <div class="option clearfix">
                    
                    <input data-controls="wpml_lang_letters" name="camp_options[]" id="replace_link" value="OPT_WPML" type="checkbox">
                    <span class="option-title">
							Set a WPML language for posted posts
                    </span>
                    <br>
                    
		            <div id="wpml_lang_letters" class="field f_100">
		               
		               <label>
		                    Two letters language code. for example add "de" for german. 
		               </label>
		               <input value="<?php   echo @$camp_general['cg_wpml_lang']   ?> " name="cg_wpml_lang"    type="text">
		               
		               <div class="option clearfix">
			               <input name="camp_options[]"  value="OPT_LINK_PREFIX" type="checkbox">
		                   <span class="option-title">
								Post item even if there is already a posted one from another campaign (By default same url get posted once)(Beta)      
		                   </span>
		                   <br><div class="description"><small><i>(This will suffix the orignal url to make a new url by adding a parameter named "rand" )</i></small></div>
		               </div>    
		             
		            </div>
		             
               </div>
		 </div>
		 
		
		<div class="clear"></div>
	</div>
</div>
</div>
