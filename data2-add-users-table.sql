-- Database: [BlogsDB]

-- --------------------------------------------------------

-- Table structure for table [Blogs_table]
CREATE TABLE [Blogs_table] (
  [BlogID] int NOT NULL IDENTITY(1,1),
  [Blog_subject] varchar(500) NOT NULL,
  [Blog_body] varchar(MAX) NOT NULL,
  [user_id] char(100) NOT NULL
);

-- Dumping data for table [Blogs_table]
SET IDENTITY_INSERT [Blogs_table] ON;

INSERT INTO [Blogs_table] ([BlogID], [Blog_subject], [Blog_body], [user_id]) VALUES
(1, 'Electrical and Fire Alarm', 'Proin risus. Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.', '13'),
(3, 'Roofing (Metal)', 'Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti. Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris. Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '15'),
(4, 'Fire Protection', 'Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede. Morbi porttitor lorem id ligula.', '16'),
(5, 'Waterproofing & Caulking', 'Morbi ut odio. Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc.', '13'),
(6, 'Masonry', 'In hac habitasse platea dictumst.', '15'),
(7, 'Epoxy Flooring', 'Etiam faucibus cursus urna. Ut tellus.', '16'),
(10, 'Structural & Misc Steel Erection', 'Aliquam quis turpis eget elit sodales scelerisque.', '13'),
(17, 'Soft Flooring and Base', 'Curabitur gravida nisi at nibh.', '15'),
(18, 'Masonry', 'Aenean fermentum. Donec ut mauris eget massa tempor convallis.', '16'),
(19, 'Waterproofing & Caulking', 'In hac habitasse platea dictumst.', '23');

SET IDENTITY_INSERT [Blogs_table] OFF;

-- --------------------------------------------------------

-- Table structure for table [users]
CREATE TABLE [users] (
  [user_id] int NOT NULL IDENTITY(1,1),
  [user_name] text NOT NULL,
  [password] text NOT NULL,
  [email_address] text,
  [admin_role] tinyint DEFAULT NULL
);

-- Dumping data for table [users]
SET IDENTITY_INSERT [users] ON;

INSERT INTO [users] ([user_id], [user_name], [password], [email_address], [admin_role]) VALUES
(13, 'ken', 'password', 'fake@fakemail.com', 1),
(15, 'bob', 'password', 'fake@fakemail.com', 0),
(16, 'jim', 'password', 'fake@fakemail.com', 0),
(17, 'cory', 'password', 'fake@fakemail.com', 0),
(18, 'danny', 'password', 'fake@fakemail.com', 0),
(19, 'lonny', 'password', 'fake@fakemail.com', 0),
(23, 'jeffrey', 'password', 'fake@fakemail.com', 0);

SET IDENTITY_INSERT [users] OFF;

-- Indexes for dumped tables

-- Indexes for table [Blogs_table]
ALTER TABLE [Blogs_table] ADD PRIMARY KEY ([BlogID]);

-- Indexes for table [users]
ALTER TABLE [users] ADD PRIMARY KEY ([user_id]);