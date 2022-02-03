<?php
/**
* Template Name: Service Landing Page
*/



get_header();
$isDirectory=true;

?>

<div class="container">
    
    
    <div id="main" class="services-page">
       
        <div id="services-search">
            <div class="search-group">
                <div class="input-wrap">
           <input required v-model="searchQuery" id="search-input" class="form-control" type="text" placeholder="Search" aria-label="Search">

           </div>
                
                <button id="search-button" v-class="{cloak : !appLoaded}" :disabled='loading' type = "button"  @click = "fetchAPIData"><span v-show="!appLoaded">Search</span><span v-cloak >{{ loading ? 'Loading...' : 'Search' }}</span></button>
            </div>
                       <span class="warning" v-cloak v-if='warningMessage'>{{warningMessage}}</span>
             <div class="search-filters">
                 <span><input type="checkbox"  value="6113" v-model="checkedNames">
<label >Podcast</label></span>
                 <span><input type="checkbox" value="47" v-model="checkedNames">
<label >Blogs</label></span>

                 <span><input type="checkbox" value="180" v-model="checkedNames">
<label >Dorset</label></span>
             </div>




           
        </div>
        
        <div id="result-area">
        <div v-cloak v-if='loading' id="loading">
    LOADING...
</div>
		<div v-cloak v-if = "responseAvailable == true">
                    <h2><span class="count">{{resultCount}}</span> results
 are available for: <span class="keyword">{{searchQuery}}</span>
</h2>
                    <div id="paginations" v-cloak>
          
            <ul >
                 
		<li v-for="index in parseInt(totalPages)"  >
                    <button     @click="onChangePage(index)" v-bind:class="[ pageOfItems==index ? 'current'  : '']"> {{ index }}</button>
                  
  </li>
         
        </ul>
        </div>
                    
        <ul class="results">
		<li v-for="item in result" >
                
                    <a target="_blank" :href="item.link">     {{ item.title.rendered }}</a>
               
                    <div class="date">Date: <b>{{item.date}}</b></div>
  </li>
         
        </ul>
		
        <hr>
</div>
    </div>
        
        
    
    </div>

    
</div>


<?php 

the_content();
 
?>
  <?php get_footer(); ?>

