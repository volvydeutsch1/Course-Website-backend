# Backend API documentation

## End Points
 The API will only work if logged in correctly (besides for initial/getAnnouncements, logins and registers)

 **Initial:**
 
 - */backend/initials/getAnnouncements* [get]

    Returns all announcements.
    
 **Student:**
 
 - */backend/students/register* [post]

    Registers account for student, returns student ID.
    
    expects the following data:
    - name (string)
    - password (string)
    
 - */backend/students/login* [post]

    Logs in student, returns account type, ID and name.
    
    expects the following data:
    - id (int)
    - password (string)
    
 - */backend/students/logout* [get]

    Logs out student.
    
 - */backend/students/addSubmission* [post]

    Adds new submission to database.
    
    expects the following data:
    - studentid (int)
    - assignmentid (int)
    - text(string)
    
 - */backend/students/listAssignments* [get]
 
     Returns all assignments specific for logged in student

 **Teacher:**
 
 - */backend/teacher/register* [post]

    Registers account for teacher, returns teacher ID.
    
    expects the following data:
    - name (string)
    - password (string)
    
 - */backend/teacher/login* [post]

    Logs in teacher, returns account type, ID and name.
    
    expects the following data:
    - id (int)
    - password (string)
    
 - */backend/teacher/logout* [get]

    Logs out teacher.
    
 - */backend/teacher/addAnnouncement* [post]

    Adds new announcement to database.
    
    expects the following data:
    - teacherid (int)
    - body (string)
    
 - */backend/teacher/deleteAnnouncement/:announcement_id* [get]
 
     Deletes announcement of that announcement_id
     
 - */backend/teacher/addAssignment* [post]
 
     Adds new assignment to database.
     
     expects the following data:
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/deleteAssignment/:assignment_id* [get]
 
     Deletes announcement of that announcement_id

- 