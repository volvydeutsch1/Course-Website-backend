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
    
 - */backend/students/logout* [post]

    Logs out student.
    
    expects the following data:
    - token (string)
    
 - */backend/students/addSubmission* [post]

    Adds new submission to database.
    
    expects the following data:
    - token (string)
    - studentid (int)
    - assignmentid (int)
    - text(string)
    
 - */backend/students/listAssignments* [post]
 
     Returns all assignments specific for logged in student
     
     expects the following data:
     - token (string)
     
 - */backend/students/addSubmission* [post]
 
     Adds new submission to database.
     
     expects the following data:
     - token (string)
     - studentid (int)
     - annoucementid (int)

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
    
 - */backend/teacher/logout* [post]

    Logs out teacher.
    
    expects the following data:
    - token (string)
    
 - */backend/teacher/addAnnouncement* [post]

    Adds new announcement to database.
    
    expects the following data:
    - token (string)
    - teacherid (int)
    - body (string)
    
 - */backend/teacher/updateAnnouncement* [post]

    Updates announcement.
    
    expects the following data:
    - token (string)
    - id (int)
    - teacherid (int)
    - body (string)
    
 - */backend/teacher/deleteAnnouncement/:announcement_id* [post]
 
     Deletes announcement of that announcement_id
     
     expects the following data:
     - token (string)
     
 - */backend/teacher/addAssignment* [post]
 
     Adds new assignment to database.
     
     expects the following data:
     - token (string)
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/updateAssignment* [post]
 
     Updates assignment.
     
     expects the following data:
     - token (string)
     - id (int)
     - teacherid (int)
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/deleteAssignment/:assignment_id* [post]
 
     Deletes announcement of that announcement_id
     
     expects the following data:
     - token (string)
     
 - */backend/teacher/listAssignments* [post]
 
     Lists all assignments
     
     expects the following data:
     - token (string)

 - */backend/teacher/listSubmissions* [post]
 
     Lists all students assignments submissions
     
     expects the following data:
     - token (string)
     
 - */backend/teacher/updateSubmission* [post]
 
     Updates students assignments submissions with grade
     
     expects the following data:
     - token (string)
     - id (string - submission id)
     - grade (float)
- 