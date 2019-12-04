<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OneFile Data Monitor</title>
    <meta name="description" content="A method of monitoring OneFile data for data analysis.">
    <meta name="keywords" content="OneFile,ACT Training">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    
    <link href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" rel="stylesheet"> <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8e29282ac5.js" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">
	

		<div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">
				
			<div class="w-1/2 pl-2 md:pl-0">
				<a class="text-gray-900 text-base xl:text-xl no-underline hover:no-underline font-bold"  href="home"> 
					<i class="fas fa-database text-blue-600 pr-3"></i> OneFile Data Monitor
				</a>
            </div>
			<div class="w-1/2 pr-0">
				<div class="flex relative inline-block float-right">
				
				  <div class="relative text-sm">
					  <button id="userButton" class="flex items-center focus:outline-none mr-3">
						<img class="w-8 h-8 rounded-full mr-4" src="https://www.gravatar.com/avatar/c5c6c68784f25b011468c5de2f12a2a1?s=32" alt="Avatar of User"> <span class="hidden md:inline-block">Hi, Simon </span>
						<svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/></g></svg>
					  </button>
					  <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
						  <ul class="list-reset">
							<li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My account</a></li>
							<li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Notifications</a></li>
							<li><hr class="border-t mx-2 border-gray-400"></li>
							<li><a href="#" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Logout</a></li>
						  </ul>
					  </div>
				  </div>


					<div class="block lg:hidden pr-4">
					<button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
						<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
					</button>
				    </div>
				</div>

			</div>


			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white z-20" id="nav-content">
				<ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
					<li class="mr-6 my-2 md:my-0">
                        <a href="home" class="block py-1 md:py-3 pl-1 align-middle text-blue-600 no-underline hover:text-gray-900 border-b-2 border-white hover:border-blue-600">
                            <i class="fas fa-home fa-fw mr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-sm">Home</span>
                        </a>
                    </li>
					<li class="mr-6 my-2 md:my-0">
                        <a href="archive" class="block py-1 md:py-3 pl-1 align-middle text-blue-600 no-underline hover:text-gray-900 border-b-2 border-blue-600 hover:border-blue-600">
                            <i class="fas fa-archive fa-fw mr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-sm">Archive</span>
                        </a>
                    </li>
				</ul>
				
				<div class="relative pull-right pl-4 pr-4 md:pr-0">
                    <input type="search" placeholder="Search" class="w-full bg-gray-100 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-2 pl-10 appearance-none leading-normal">
                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                        <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </div>
				
			</div>
			
		</div>
	</nav>

	<!--Container-->
	<div class="container w-full mx-auto pt-20">
		
		<div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            <div class="flex flex-row flex-wrap flex-grow mt-2">

            <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Archive Candidates</h5>
                        </div>
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                                        <th class="text-left text-blue-700">Name</th>
                                        <th class="text-left text-blue-700">Created</th>
                                        <th class="text-left text-blue-700">Last Login</th>
                                        <th class="text-left text-blue-700">Last Modified</th>
                                        <th class="text-left text-blue-700">Progress</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php foreach ($candidates as $candidate): ?>
                                    <tr>
                                        <td><?=$candidate['FirstName'] . ' ' . $candidate['LastName'];?></td>
                                        <td><?=date("m.d.y", strtotime($candidate['DateCreated']));?></td>
                                        <td><?=date("m.d.y", strtotime($candidate['DateLogin']));?></td>
                                        <td><?=date("m.d.y", strtotime($candidate['DateModified']));?></td>
                                        <td><?=$candidate['Progress'];?>%</td>
                                    </tr>  
                                <?php endforeach; ?>                               
                                </tbody>
                            </table>

                            <!-- <p class="py-2"><a href="#">See More issues...</a></p> -->

                        </div>
                    </div>
                    <!--/table Card-->
                </div>

            </div>
								
					
		</div>
		

	</div> 
	<!--/container-->

<script>
	
	
	/*Toggle dropdown list*/
	/*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

	var userMenuDiv = document.getElementById("userMenu");
	var userMenu = document.getElementById("userButton");
	
	var navMenuDiv = document.getElementById("nav-content");
	var navMenu = document.getElementById("nav-toggle");
	
	document.onclick = check;

	function check(e){
	  var target = (e && e.target) || (event && event.srcElement);

	  //User Menu
	  if (!checkParent(target, userMenuDiv)) {
		// click NOT on the menu
		if (checkParent(target, userMenu)) {
		  // click on the link
		  if (userMenuDiv.classList.contains("invisible")) {
			userMenuDiv.classList.remove("invisible");
		  } else {userMenuDiv.classList.add("invisible");}
		} else {
		  // click both outside link and outside menu, hide menu
		  userMenuDiv.classList.add("invisible");
		}
	  }
	  
	  //Nav Menu
	  if (!checkParent(target, navMenuDiv)) {
		// click NOT on the menu
		if (checkParent(target, navMenu)) {
		  // click on the link
		  if (navMenuDiv.classList.contains("hidden")) {
			navMenuDiv.classList.remove("hidden");
		  } else {navMenuDiv.classList.add("hidden");}
		} else {
		  // click both outside link and outside menu, hide menu
		  navMenuDiv.classList.add("hidden");
		}
	  }
	  
	}

	function checkParent(t, elm) {
	  while(t.parentNode) {
		if( t == elm ) {return true;}
		t = t.parentNode;
	  }
	  return false;
	}


</script>

</body>
</html>