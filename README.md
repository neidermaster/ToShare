# ToShare

EN / ES

# ENGLISH
##################################

# External Consultation Module for the Document Management System ORFEO Version 3.8 or later and 7.0

This consultation module was developed as part of the improvement for the Document Management System ORFEO
for the Administrative Department of the Public Space Ombudsman.

* Requesting Office: File
* Head of Applicant Office: Luz Stella Bahamón
* Office in Charge: Systems Office
* Head of Office: Ing. Claudia Paipa
* Development leader: Ing. Neider Avendaño
* Original development: 2013
* Original License: GPL
* Deployment date: April 2020

The original module was within the same application and after having identified security problems
it was decided to modify it so that it would be totally independent of the application server in the production environment.

##############################

Configuration details:

This module is developed with MVC pattern
for its operation it is recommended:
1) copy the complete folder inside the web server of the company's main page
2) Modify the access parameters to the server and the company's Database by entering the file:
webquery/app/config/config.php
3) The Google ReCaptcha validation container module, for which you must:
   - Create Captcha credentials for Google with the data from the company's Web portal
   - Copy the credentials to the app/views/main/index.php file
     look for the following line: <div class="g-recaptcha panel_captcha" data-sitekey="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
     Replace the value "XXXXX" with the Google credentials for your company.
4) Create a frame within the Web page where you want the query module to be accessed
  It is recommended to set the size to half a page, it is enough to display the form.
  Create an access to the index.php file
5) Reload the web page and validate the functioning of the module.
  
  
  ############################
  
  FUNCTIONS
  The Module allows you to check the status of a file in the Document Management System ORFEO v. 3.8 or later and/or 7
  The required parameters are:
  - Complete filing number (12 numerical values)
  - Confirmation code (5 alphanumeric characters)
  - ReCaptcha Google confirmation, necessary to validate the non-intervention of automatic systems.
  
  Once the data has been entered, you will be able to click on the search button.
  
  The program will connect to the ORFEO Database validating that the entered parameters are correct and valid.
  The origin and the privacy or confidentiality settings of the documents are validated before generating the information display.
  Once the validation has passed, the specific information of the filing is obtained, you obtain
  - Petitioner Parameters
  - Recipient Parameters
  - Basic data of the filing (Issue, date, Description, pages, annexes, etc.)
  - Access parameters to documents stored in the repository that correspond to the filing are obtained.
  
  NOTE: In case the filings are Internal, Memoranda, Confidential, or Human Resources
  In this case, a message is generated indicating to the user that the documents are confidential and their information cannot be displayed.
  
  Then the information is organized and displayed in a template for the user informing:
  - Filing number
  - Filing date
  - responsible for the process
  - Status of the process
  - Attached documents (these with the option to preview them on screen)
  
  
  
# SPANISH
##################################

# Módulo Externo de Consulta para el Sistema de Gestión Documental ORFEO Versión 3.8 o posteriores y 7.0

Este módulo de consulta fue desarrollado como parte de la mejora para el Sistema de Gestión Documental ORFEO
para el Departamento Administrativo de la Defensoría del Espacio Público.

* Oficina Solicitante: Archivo
* Jefe Oficina solicitante: Luz Stella Bahamón
* Oficina Encargada: Oficina de Sistemas
* Jefe de Oficina: Ing. Claudia Paipa
* Líder de desarrollo: Ing. Neider Avendaño
* Desarrollo original: 2013
* Licencia Original: GPL
* Fecha despliegue: abril 2020

EL Módulo original se encontraba dentro del mismo aplicativo y luego de haber identificado problemas de seguridad
se decidió modificarlo de manera que fuese totalmente independiente del servidor de aplicaciones en ambiente de producción.

##############################

Detalles de la configuración:

Este módulo esta desarrollado con patrón MVC
para su funcionamiento se recomienda:
1) copiar la carpeta completa dentro del servidor Web de la página principal de la empresa
2) Modificar los parámetros de acceso al servidor y la Base de Datos de la empresa ingresando al fichero:
consultaWeb/app/config/config.php
3) El módulo continente validación ReCaptcha de Google, para lo cual debe:
   - Crear credenciales Captcha para Google con los datos del portal Web de la empresa
   - Copie las credenciales en el fichero app/views/main/index.php
     busque la línea siguiente: <div class="g-recaptcha panel_captcha" data-sitekey="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
     Reemplace el valor "XXXXX" por las credenciales de Google para su empresa.
4) Cree un frame dentro de la página Web donde quiere que se acceda al módulo de consulta
  Se recomienda ajustar el tamaño a media página, es el tamaño suficiente para mostrar el formulario.
  Cree un acceso al fichero index.php
5) Recargue la paina Web y valide el funcionamiento del módulo.
  
  
  ############################
  
  FUNCIONES
  El Módulo permite consultar el estado de un radicado en el Sistema de Gestión Documental ORFEO v. 3.8 o posterior y/o 7
  Los parámetros exigidos son:
  - Numero de radicación completo (12 valores numéricos)
  - Código de confirmación (5 caracteres alfanuméricos)
  - Confirmación ReCaptcha Google, necesaria para validar la no intervención de sistemas automáticos.
  
  Una vez ingresados los datos, podrá hacer clic en el botón de búsqueda.
  
  El programa se conectará a la Base de Datos de ORFEO validando que los parámetros ingresados sean correctos y válidos.
  Se valida el origen y las configuraciones de privacidad o confidencialidad de los documentos antes de generar el despliegue de la información.
  Una vez haya pasado la validación, se procede a obtener la información especifica del radicado, se obtienes
  - Parámetros del Peticionario
  - Parámetros del Destinatario
  - Datos básicos de la radicación (Asunto, fecha, Descripción, folios, anexos, etc.)
  - Se obtienen los parámetros de acceso a documentos almacenados en el repositorio que corresponden al radicado.
  
  NOTA: EN caso de que los radicados sean Internos, Memorandos, Confidenciales, o de Recursos Humanos
  En este caso se genera un mensaje indicando al usuario que los documentos son de carácter confidencial y no se puede mostrar la información de los mismos.
  
  Luego la información se organiza y es desplegada en plantilla para el usuario informando:
  - Numero de Radicado
  - Fecha de radicación
  - responsable del tramite
  - Estado del tramite
  - Documentos anexos (estos con la opción de previsualizarlos en pantalla).
  
  
  #
  #
  #
  # FINISH
  #
  #
  #
