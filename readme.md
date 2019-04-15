# Backend API documentation

## End Points
 This API will initially load the home page including ALL Announcements.
 It will then require register/login for any Teacher/Student to access further features that
 will be validated using token header.

 **Initial:**
 
 - */backend/initials/getAnnouncements* [get]

    Returns all announcements.
 
 - */backend/initials/register* [post]

    Creates a new account for Teacher/Student.
    
    Input data:
    - accountType (string - 'teacher'/'student')
    - name (string)
    - password (string)
    
    Output: TeacherID / StudentID.
    
 - */backend/initials/login* [post]

    Logs in Teacher/Student.
    
    Input data:
    - accountType (string - 'teacher'/'student')
    - id (int)
    - password (string)
    
    Output: ID / Name.
    
 - */backend/initials/logout*

    Logs out Teacher/Student.
    
    uses logged in Authorization header
    
  **Student:**
 
  - */backend/students/getAnnouncements* [get]
 
     Returns all announcements for logged-in student with Date_Read (if applicable)
     
     Input data:
          - StudentID (int)  
    
 - */backend/students/listAssignments* [post]
 
     Returns all assignments as well as Submission Date (if applicable) for logged in Student
     
     Input data:
     - StudentID (int)
     
     Output: Assignment Data with associated Submission Date (if applicable)
     
  - */backend/students/addAnnouncementRead* [post]
   
       Adds new AnnouncementRead to database for Announcement marked Read By Student.
       
       Input data:
       - Studentid (int)
       - Announcementid (int) 
     
 - */backend/students/addSubmission* [post]
 
     Adds new submission to database for UnSubmitted Assignments.
     
     Input data:
     - StudentID (int)
     - AssignmentID (int)
     - text(string)

 **Teacher:**
    
 - */backend/teachers/addAnnouncement* [post]

    Adds new Announcement to database.
    
    Input data:
    - TeacherID (int)
    - body (string)
    
 - */backend/teachers/updateAnnouncement* [post]

    Updates announcement.
    
    Input data:
    - AssignmentID (int)
    - TeacherID (int)
    - body (string)
    
 - */backend/teachers/deleteAnnouncement* [post]
 
     Deletes announcement from database.
     
     Input data:
     - AnnouncementID (int)
     
 - */backend/teachers/addAssignment* [post]
 
     Adds new assignment to database.
     
     Input data:
     - TeacherID (int)
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teacher/updateAssignment* [post]
 
     Updates assignment.
     
     Input data:
     - AssignmentID (int)
     - TeacherID (int)
     - subject (string)
     - releasedate (string)
     - duedate (string)
     - body (string)
     
 - */backend/teachers/deleteAssignment* [post]
 
     Deletes announcement from database.
     
     Input data:
     - AssignmentID (int)
     
 - */backend/teachers/listAssignments* [post]
 
     Lists all assignments for logged in Teacher
     
     Input data:
     - TeacherID (int)

 - */backend/teacher/listSubmissions* [post]
 
     Lists all submissions for any given Assignment
     
     Input data:
     - AssignmentID (int)
     
 - */backend/teachers/updateSubmission* [post]
 
     Updates Submission record with grade
     
     Input data:
     - SubmissionID (int)
     - grade (float)
