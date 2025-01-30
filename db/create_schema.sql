USE wordpress;

DROP TABLE IF EXISTS hpha_departments_users_roles;
DROP TABLE IF EXISTS hpha_departments;
DROP TABLE IF EXISTS hpha_users;
DROP TABLE IF EXISTS hpha_roles;
DROP VIEW IF EXISTS hpha_departments_users_summary_view;
DROP VIEW IF EXISTS hpha_department_roles_view;
DROP VIEW IF EXISTS hpha_users_dropdown_view;
DROP VIEW IF EXISTS hpha_departments_users_dropdown_view;

CREATE TABLE hpha_departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    function_centre_number VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE hpha_departments
ADD UNIQUE INDEX unique_department (function_centre_number);

CREATE TABLE hpha_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    wp_user_id BIGINT UNSIGNED,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (wp_user_id) REFERENCES wp_users(ID)
);

ALTER TABLE hpha_users
ADD UNIQUE INDEX unique_user (email);

CREATE TABLE hpha_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE hpha_roles
ADD UNIQUE INDEX unique_role (name);

INSERT INTO hpha_roles (name) VALUES
    ('Delegate 1'),
    ('Delegate 2'),
    ('Delegate 3'),
    ('Delegate 4'),
    ('Delegate 5'),
    ('Manager'),
    ('Director'),
    ('VP for Department'),
    ('VP / CFE'),
    ('CEO'),
    ('Tester');

CREATE TABLE hpha_departments_users_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT,
    user_id INT,
    role_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES hpha_departments(id),
    FOREIGN KEY (user_id) REFERENCES hpha_users(id),
    FOREIGN KEY (role_id) REFERENCES hpha_roles(id)
);

ALTER TABLE hpha_departments_users_roles
ADD UNIQUE INDEX unique_department_user_role (department_id, user_id, role_id);

-- view to get all users and their roles in a department
CREATE OR REPLACE VIEW hpha_departments_users_summary_view AS
    SELECT 
        d.name AS department_name,
        d.function_centre_number,
        CONCAT(d.function_centre_number, ' - ', d.name) AS department_function_centre,
        us.wp_user_id,
        us.id AS user_id,
        us.email AS user_email
    FROM hpha_departments d
    JOIN hpha_departments_users_roles dur ON d.id = dur.department_id
    JOIN hpha_users us ON dur.user_id = us.id;

-- view to get all roles in a department
CREATE OR REPLACE VIEW hpha_department_roles_view
AS
    SELECT 
        hd.id AS department_id,
        hd.name AS department_name,
        hd.function_centre_number,
        delegate1.wp_user_id AS delegate_1_wp_user_id,
        delegate1.email AS delegate_1_email,
        delegate2.wp_user_id AS delegate_2_wp_user_id,
        delegate2.email AS delegate_2_email,
        delegate3.wp_user_id AS delegate_3_wp_user_id,
        delegate3.email AS delegate_3_email,
        delegate4.wp_user_id AS delegate_4_wp_user_id,
        delegate4.email AS delegate_4_email,
        delegate5.wp_user_id AS delegate_5_wp_user_id,
        delegate5.email AS delegate_5_email,
        manager.wp_user_id AS manager_wp_user_id,
        manager.email AS manager_email,
        director.wp_user_id AS director_wp_user_id,
        director.email AS director_email,
        vp_department.wp_user_id AS vp_department_wp_user_id,
        vp_department.email AS vp_department_email,
        vp_cfe.wp_user_id AS vp_cfe_wp_user_id,
        vp_cfe.email AS vp_cfe_email,
        ceo.wp_user_id AS ceo_wp_user_id,
        ceo.email AS ceo_email,
        board_chair.wp_user_id AS board_chair_wp_user_id,
        board_chair.email AS board_chair_email
    FROM 
        hpha_departments hd 
    LEFT JOIN 
    	hpha_departments_users_roles du1 ON hd.id = du1.department_id AND du1.role_id = (SELECT id FROM hpha_roles WHERE name = 'Delegate 1')
    LEFT JOIN 
    	hpha_users delegate1 ON du1.user_id = delegate1.id
    LEFT JOIN 
    	hpha_departments_users_roles du2 ON hd.id = du2.department_id AND du2.role_id = (SELECT id FROM hpha_roles WHERE name = 'Delegate 2')
    LEFT JOIN 
    	hpha_users delegate2 ON du2.user_id = delegate2.id
    LEFT JOIN 
    	hpha_departments_users_roles du3 ON hd.id = du3.department_id AND du3.role_id = (SELECT id FROM hpha_roles WHERE name = 'Delegate 3')
    LEFT JOIN 
    	hpha_users delegate3 ON du3.user_id = delegate3.id
    LEFT JOIN 
		hpha_departments_users_roles du4 ON hd.id = du4.department_id AND du4.role_id = (SELECT id FROM hpha_roles WHERE name = 'Delegate 4')
    LEFT JOIN 
		hpha_users delegate4 ON du4.user_id = delegate4.id
    LEFT JOIN 
		hpha_departments_users_roles du5 ON hd.id = du5.department_id AND du5.role_id = (SELECT id FROM hpha_roles WHERE name = 'Delegate 5')
    LEFT JOIN 
		hpha_users delegate5 ON du5.user_id = delegate5.id
    LEFT JOIN 
		hpha_departments_users_roles dum ON hd.id = dum.department_id AND dum.role_id = (SELECT id FROM hpha_roles WHERE name = 'Manager')
    LEFT JOIN 
		hpha_users manager ON dum.user_id = manager.id
    LEFT JOIN 
		hpha_departments_users_roles dud ON hd.id = dud.department_id AND dud.role_id = (SELECT id FROM hpha_roles WHERE name = 'Director')
    LEFT JOIN 
		hpha_users director ON dud.user_id = director.id
    LEFT JOIN 
		hpha_departments_users_roles duvpdep ON hd.id = duvpdep.department_id AND duvpdep.role_id = (SELECT id FROM hpha_roles WHERE name = 'VP for Department')
    LEFT JOIN 
		hpha_users vp_department ON duvpdep.user_id = vp_department.id
    LEFT JOIN 
		hpha_departments_users_roles duvpcfe ON hd.id = duvpcfe.department_id AND duvpcfe.role_id = (SELECT id FROM hpha_roles WHERE name = 'VP / CFE')
    LEFT JOIN 
		hpha_users vp_cfe ON duvpcfe.user_id = vp_cfe.id
    LEFT JOIN 
		hpha_departments_users_roles duceo ON hd.id = duceo.department_id AND duceo.role_id = (SELECT id FROM hpha_roles WHERE name = 'CEO')
    LEFT JOIN 
		hpha_users ceo ON duceo.user_id = ceo.id
    LEFT JOIN 
		hpha_departments_users_roles dubc ON hd.id = dubc.department_id AND dubc.role_id = (SELECT id FROM hpha_roles WHERE name = 'Board Chair')
    LEFT JOIN 
		hpha_users board_chair ON dubc.user_id = board_chair.id;

CREATE OR REPLACE VIEW hpha_users_dropdown_view AS
    SELECT 
        0 AS id,
        '' AS email
    UNION ALL
    SELECT 
        t.id,
        t.email
    FROM hpha_users t;

CREATE OR REPLACE VIEW hpha_departments_users_dropdown_view AS
    SELECT 
        '' AS department_name,
        '' AS function_centre_number,
        '' AS department_function_centre,
        0 AS wp_user_id,
        0 AS user_id,
        '' AS user_email
    UNION ALL
    SELECT 
        t.department_name,
        t.function_centre_number,
        t.department_function_centre,
        t.wp_user_id,
        t.user_id,
        t.user_email
    FROM hpha_departments_users_summary_view t