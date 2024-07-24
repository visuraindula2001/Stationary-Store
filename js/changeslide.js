function toggleTableEVisibility() {
    var tableSection = document.getElementById('product-table');
    var table_order = document.getElementById('order');
    var nnnSection = document.getElementById('nnn');
    var bar = document.getElementById('bar');
    
    table_order.style.display = 'flex';
    nnnSection.style.display = 'none';
    tableSection.style.display = 'flex';
    bar.style.display = 'flex';
  }
  
  function toggleTableVisibility() {
    var tableSection = document.getElementById('product-table');
    var nnnSection = document.getElementById('nnn');
    var table_order = document.getElementById('order');
    var bar = document.getElementById('bar');

    tableSection.style.display = 'none';
    nnnSection.style.display = 'flex';
    table_order.style.display = 'none';
    bar.style.display = 'none';
  }
  
  
  function change1(){
      
  var ondiv1 = document.getElementsByClassName('onec')[0];
  var ondiv2 = document.getElementsByClassName('twoc')[0];

  var h1tags = document.getElementsByClassName('hh1')[0];
  var h2tags = document.getElementsByClassName('hh2')[0];

  h1tags.style.color='black';
  h2tags.style.color='white';

  ondiv2.style.backgroundColor = '#30b266';
  ondiv1.style.backgroundColor = 'white';

  ondiv1.style.borderTop = '2px solid';
  ondiv1.style.borderRight = '2px solid';
  ondiv2.style.borderBottom='2px solid';

  ondiv2.style.borderTop='none';
  ondiv2.style.borderLeft='none';
  ondiv1.style.borderBottom = 'none';

  toggleTableEVisibility()
   
  
   
  
    }
  
    function change2(){
       
  var ondiv1 = document.getElementsByClassName('onec')[0];
  var ondiv2 = document.getElementsByClassName('twoc')[0];
  
  var h1tags = document.getElementsByClassName('hh1')[0];
  var h2tags = document.getElementsByClassName('hh2')[0];

  h1tags.style.color='white';
  h2tags.style.color='black';
   
  ondiv2.style.backgroundColor = 'white';
  ondiv1.style.backgroundColor ='#30b266'; 

  ondiv1.style.borderTop = 'none';
  ondiv1.style.borderRight = 'none';
  ondiv2.style.borderBottom='none';

  ondiv2.style.borderTop='2px solid';
  ondiv2.style.borderLeft='2px solid';
  ondiv1.style.borderBottom = '2px solid';

  toggleTableVisibility()
   
   
  
    }



    /////////----------------------------super admin for--------------------------------------------------
    function toggleATableEVisibility() {
      var tableSection = document.getElementById('product-table');
      var table_order = document.getElementById('order');
      var nnnSection = document.getElementById('nnn');
      var adminformSection = document.getElementById('adminform');
      var bar = document.getElementById('bar');
      
      table_order.style.display = 'flex';
      bar.style.display = 'flex';
      tableSection.style.display = 'flex';
      nnnSection.style.display = 'none';
      adminformSection.style.display = 'none';
    }
    
    function toggleBTableVisibility() {
      var tableSection = document.getElementById('product-table');
      var nnnSection = document.getElementById('nnn');
      var table_order = document.getElementById('order');
      var adminformSection = document.getElementById('adminform');
      var bar = document.getElementById('bar');

      tableSection.style.display = 'none';
      bar.style.display = 'none';
      nnnSection.style.display = 'none';
      table_order.style.display = 'none';
      adminformSection.style.display = 'flex';
    }

    function toggleCTableVisibility() {
      var tableSection = document.getElementById('product-table');
      var nnnSection = document.getElementById('nnn');
      var table_order = document.getElementById('order');
      var adminformSection = document.getElementById('adminform');
      var bar = document.getElementById('bar');

      tableSection.style.display = 'none';
      bar.style.display = 'none';
      nnnSection.style.display = 'flex';
      table_order.style.display = 'none';
      adminformSection.style.display = 'none';
    }





    ///////////////////////
    function achange1(){
      
      var ondiv1 = document.getElementsByClassName('oned')[0];
      var ondiv2 = document.getElementsByClassName('twod')[0];
      var ondiv3 = document.getElementsByClassName('thrd')[0];
    
      var h1tags = document.getElementsByClassName('dd1')[0];
      var h2tags = document.getElementsByClassName('dd2')[0];
      var h3tags = document.getElementsByClassName('dd3')[0];
    
      h1tags.style.color='black';
      h2tags.style.color='white';
      h3tags.style.color='white';

      ondiv3.style.backgroundColor = '#30b266';
      ondiv2.style.backgroundColor = '#30b266';
      ondiv1.style.backgroundColor = 'white';
    
      ondiv1.style.borderTop = '2px solid';
      ondiv1.style.borderRight = '2px solid';
      ondiv2.style.borderBottom='2px solid';
      ondiv2.style.borderRight='2px solid';
      ondiv3.style.borderBottom='2px solid';

      ondiv1.style.borderBottom='none';
      ondiv2.style.borderTop='none';
      ondiv2.style.borderLeft='none';
      ondiv2.style.borderRadius='0 0 0 0';
       
      ondiv3.style.borderTop = 'none';
      ondiv3.style.borderLeft = 'none';
    
      toggleATableEVisibility()
       
      
       
      
        }




        function achange2(){
      
          var ondiv1 = document.getElementsByClassName('oned')[0];
          var ondiv2 = document.getElementsByClassName('twod')[0];
          var ondiv3 = document.getElementsByClassName('thrd')[0];
        
          var h1tags = document.getElementsByClassName('dd1')[0];
          var h2tags = document.getElementsByClassName('dd2')[0];
          var h3tags = document.getElementsByClassName('dd3')[0];
        
          h2tags.style.color='black';
          h1tags.style.color='white';
          h3tags.style.color='white';
    
          ondiv3.style.backgroundColor = '#30b266';
          ondiv1.style.backgroundColor = '#30b266';
          ondiv2.style.backgroundColor = 'white';
        
          ondiv2.style.borderTop = '2px solid';
          ondiv2.style.borderRight = '2px solid';
          ondiv2.style.borderLeft='2px solid';
          ondiv2.style.borderRadius='2em 2em 0 0';
          ondiv1.style.borderBottom='2px solid';
          ondiv3.style.borderBottom='2px solid';
          
    
          ondiv2.style.borderBottom='none';
          ondiv1.style.borderTop='none';
          ondiv1.style.borderRight='none';
          ondiv3.style.borderLeft='none';
          ondiv3.style.borderTop = 'none';
          
        
          toggleBTableVisibility()
           
          
           
          
            }


            function achange3(){
      
              var ondiv1 = document.getElementsByClassName('oned')[0];
              var ondiv2 = document.getElementsByClassName('twod')[0];
              var ondiv3 = document.getElementsByClassName('thrd')[0];
            
              var h1tags = document.getElementsByClassName('dd1')[0];
              var h2tags = document.getElementsByClassName('dd2')[0];
              var h3tags = document.getElementsByClassName('dd3')[0];
            
              h3tags.style.color='black';
              h1tags.style.color='white';
              h2tags.style.color='white';
        
              ondiv2.style.backgroundColor = '#30b266';
              ondiv1.style.backgroundColor = '#30b266';
              ondiv3.style.backgroundColor = 'white';
            
              ondiv3.style.borderTop = '2px solid';
              ondiv3.style.borderLeft='2px solid';
              ondiv2.style.borderRadius='0 0 0 0';
              ondiv1.style.borderBottom='2px solid';
              ondiv2.style.borderBottom='2px solid';
              ondiv2.style.borderLeft='2px solid';
              
        
            
              ondiv1.style.borderTop='none';
              ondiv1.style.borderRight='none';
              ondiv2.style.borderTop='none';
              ondiv2.style.borderRight='none';

               
              ondiv3.style.borderBottom='none';
               
              
            
              toggleCTableVisibility()
               
              
               
              
                }