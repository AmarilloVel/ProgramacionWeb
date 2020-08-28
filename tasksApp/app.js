$(function(){

    //escondemos los resultados para solo sacarlos cuando haya una busqueda
    $('#task-result').hide();
    fetchTask();
    let edit = false;
    
        

        //cada vez que una tecla se presione una tecla en el buscador, que haga una busqueda
        $('#search').keyup(function(e){

           if($('#search').val()){
                let search = $('#search').val();
                console.log(search);
        
                //usamos la funcion ajax la cual nos pide un obj
                $.ajax({
                    url: 'task-search.php',
                    type: 'POST',
                    data: {
                        search  
                    },
                    success: function(response){
                        //lo volvemos a converti en jason para usarlo en el frontend
                        let tasks = JSON.parse(response);
                        console.log(tasks);
                        
                        let founds='';
                        
                        //recorremos tareas para mostrarlas
                        tasks.forEach(task =>{
                        
                            founds +=`
                            <li>${task.name}</li>
                            `
                        }); 
        
                        $('#container').html(founds);
                        $('#task-result').show();
                    }
        
                })//ajax es un metodo de jquery que recibe un obj
            }
        } );

        //añadir otra tarea function
        $('#task-form').submit(function(e){
            const postData = {
                name: $('#name').val(),
                description: $('#description').val(),
                id: $('#taskId').val()
            }

            //si la variable edit es falso que lo envie la primera
            let url= edit === false ? 'task-add.php' : 'task-edit.php';
            console.log(url);
             
            
            
            $.post(url,postData, function(resp){
                console.log(resp);
                //reseteamos el post de las tareas para mostrar la nueva
                fetchTask(); 

                //funcion 'triger reset' para resetear el formulario cada vez que se haga un llenados
                $('#task-form').trigger('reset');
            })
            e.preventDefault();
        });

        //funcion  para hacer la lista de tareas
        function fetchTask(){
            $.ajax({
                url: "task-list.php",
                type: "GET",
                success: function(response){
                   let tasks =  JSON.parse(response);
                   let template ='';
                   //cada vez que se recorra llenaremos la plantilla
                   tasks.forEach(task => {
                       //agregamos botones y los metemos en una misma clase para despues poder manipularlos, 
                       //tambien a la clase que contiene el id para identificarlos
                        template += `
                            <tr taskId =${task.id}>
                                <td>
                                    <a href="#" class ="task-item">${task.name}</a>
                                </td>
                                <td>${task.description}</td>
                                <td >${task.id}</td>
                                <td>
                                    <button class="task-delete btn btn-danger">
                                        Delete
                                    </button>
                                <td>
                            </tr>
                        `
                   });
                   $('#tasks').html(template);
    
                   
                }
            });
        }

        //creamos evento un evento tipo click para todos los elementos que tengan esa clase   
        $(document).on('click','.task-delete', function () {
            //el proceso de eliminar se hara cuando haya confirmado el user
           if(confirm('Are you sure you wanna to delete it?')){
               //this es nuestra task-delete y de ahi seleccionamos su clase madre que es la tabla
               //para poder despues seleccionar el id del elemento que queremos eliminar
            let element = $(this)[0].parentElement.parentElement;  
            let id = $(element).attr('taskId');  
            //usamos metodo post para ejecutar nuestro codigo de php y le pasamos el id(obj)
            $.post('task-delete.php',{id},function(response){
                 
                //refrescamos las tareas cuando se haya eliminado 
                 fetchTask();
            })    
    
           }
        })

        //evento click para los obj con clase task-item 
        $(document).on('click','.task-item',function(){
            //accedemos al id mediante el nombre para poder obtener todos los datos
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');

            //metodo post que nos regresara un json de nuestra tarea seleccionada
            $.post('task-single.php',{id},function(response){
                console.log(response);
                
                //recibimos las tareas con obj json, llenamos el formulario con la tarea
                const task = JSON.parse(response);
                $('#name').val(task.name);
                $('#description').val(task.description);
                $("#taskId").val(task.id);
                edit = true;
            });
            
        })
    



});