# Backend API documentation

## End Points
 The API will only work if logged in correctly using token header (besides for initial class methods)

 **Initial:**
 
 - */backend/initials/getAnnouncements* [get]

    Returns all announcements.
 
 - */backend/initials/register* [post]

    Creates a new account for teacher/student, returns teacher/student ID.
    
    expects the following data:
    - accountType (string - teacher/student)
    - name (string)
    - password (string)
    
 - */backend/initials/login* [post]

    Logs in teacher/student, returns account type, ID and name.
    
    expects the following data:
    - accountType (string - teacher/student)
    - id (int)
    - password (string)
    
 - */backend/initials/logout*

    Logs out teacher/student.
    
    uses logged in Authorization header
    
  **Student:**
 
 - */backend/students/addSubmission* [post]

    Adds new submission to database.
    
    expects the following data:
    - studentid (int)
    - assignmentid (int)
    - text(string)
    
 - */backend/students/listAssignments* [post]
 
     Returns all assignments specific for logged in student
     
     expects the following data:
     - student_id (int)
     
 - */backend/students/addSubmission* [post]
 
     Adds new submission to database.
     
     expects the following data:
     - studentid (int)
     - annoucementid (int)

 **Teacher:**
    
 - */backend/teacher/addAnnouncement* [post]

    Adds new announcement to database.
    
    expects the following data:
    - teacherid (int)
    - body (string)
    
 - */backend/teacher/updateAnnouncement* [post]

    Updates announcement.
    
    expects the following data:
    - id (int)
    - teacherid (int)
    - body (string)
    
 - */backend/teacher/deleteAnnouncement* [post]
 
     Deletes announcement of that announcement_id
     
     expects the following data:
     - id (int)
     
 - */backend/teacher/addAssignment* [post]
 
     Adds new assignment to database.
     
     expects the following data:
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/updateAssignment* [post]
 
     Updates assignment.
     
     expects the following data:
     - id (int)
     - teacherid (int)
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/deleteAssignment* [post]
 
     Deletes announcement of that assignment_id
     
     expects the following data:
     - id (int)
     
 - */backend/teacher/listAssignments* [post]
 
     Lists all assignments
     
     expects the following data:
     - teacher_id (int)

 - */backend/teacher/listSubmissions* [post]
 
     Lists all students assignments submissions
     
     expects the following data:
     - assignment_id (int)
     
 - */backend/teacher/updateSubmission* [post]
 
     Updates students assignments submissions with grade
     
     expects the following data:
     - id (string - submission id)
     - grade (float)
- 