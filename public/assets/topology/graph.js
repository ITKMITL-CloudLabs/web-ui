var model = graph;

window.gettext = function (msgid) {
  var catalog = {"1":"1","2":"2","3":"3","4":"4","5":"5","6":"6","7":"7","8":"8","#":"#","%(name)s deleted.":"已删除 %(name)s。","%s instance launched.":["启动了 %s 个实例。"],"(None)":"（无）","<input>\n                Public</input>":"<input>\n                公开</input>","<input>\n        Configuration Drive\n      </input>":"<input>\n        配置驱动器\n      </input>","<li><b>Image (with Create New Volume checked)</b>: This options uses an image to boot the instance, and creates a new volume to persist instance data. You can specify volume size and whether to delete the volume on deletion of the instance.</li>":"<li><b>映像（带有选中“创建新卷”）</b>：此选项使用映像来启动实例，并且创建一个新卷来持久化实例数据。您可以指定卷大小并指定在删除实例时是否删除实例。</li>","<li><b>Image</b>: This option uses an image to boot the instance.</li>":"<li><b>映像</b>：此选项使用一个映像来启动实例。</li>","<li><b>Instance Snapshot</b>: This option uses an instance snapshot to boot the instance.</li>":"<li><b>实例快照</b>：此选项使用一个实例快照来启动实例。</li>","<li><b>Volume Snapshot</b>: This option uses a volume snapshot to boot the instance, and creates a new volume to persist instance data. You can choose to delete the volume on deletion of the instance.</li>":"<li><b>卷快照</b>：此选项使用卷快照启动实例，并且创建一个新卷来持久化实例数据。您可以选择在删除实例时删除卷。</li>","<li><b>Volume</b>: This option uses a volume that already exists. It does not create a new volume. You can choose to delete the volume on deletion of the instance. <em>Note: when selecting Volume, you can only launch one instance.</em></li>":"<li><b>卷</b>：这个选项使用一个已存在的卷。它不创建新卷。您可以选择在删除实例时删除卷。<em>注意：当选择卷时，您只能启动一个实例。</em></li>","<small>This line of text is meant to be treated as fine print.</small>":"<small>这行文字为了更好的打印。</small>","A container is a storage compartment for your data and provides a way\n          for you to organize your data. You can think of a container as a\n          folder in Windows or a directory in UNIX. The primary difference\n          between a container and these other file system concepts is that\n          containers cannot be nested. You can, however, create an unlimited\n          number of containers within your account. Data must be stored in a\n          container so you must have at least one container defined in your\n          account prior to uploading data.":"容器是储存您数据的存储室，\n提供便于您组织数据的方法。\n您可以认为容器是 Windows 中的文件夹，\n或者 Unix 中的目录。\n容器和这些文件系统的主要区别是容器无法嵌套。\n但是，您可以在您的账号下创建无限个容器。\n数据必须存储在容器里，\n因此您必须在上传数据前在您的帐号下定义至少一个容器。","A floating IP allows instances to be addressable from an external network.\n    Floating IPs are not allocated to instances at creation time and may be assigned\n    after the instance is created. To attach a floating IP, go to the <b>Instances</b>\n    view and click the <b>Actions</b> menu to the right of an instance.\n    Then, select the <b>Associate Floating IP</b> option and enter the necessary details.":"浮动 IP 允许实例从外部网络寻址。\n实例在创建时浮动 IP 地址时并不会分配，可在创建实例后进行指定。\n要附加浮动 IP，请转至<b>实例</b>视图并单击某个实例右边的\n<b>操作ctions</b>菜单。\n然后，选择<b>关联浮动 IP</b> 选项并输入必要的详细信息。","A key pair allows you to SSH into your newly created instance.\n    You may select an existing key pair, import a key pair, or generate a new key pair.":"密钥对允许您 SSH 到新创建的实例。\n  您可以选择一个已现有的密钥对、导入一个密钥对或生成一个新的密钥对。","A key pair named '{$ctrl.createdKeypair.name$}' was successfully created. This key pair should automatically download.":"已成功创建名为 '{$ctrl.createdKeypair.name$}' 的密钥对。应该已经自动下载此密钥对。","A name is required for your instance.":"实例需要名称。","A port represents a virtual switch port on a logical network switch.":"端口代表着逻辑网络交换机里的虚拟交换机端口。","AKI":"AKI","AMI":"AMI","ARI":"ARI","Action":"操作","Actions":"操作","Active":"活动","Admin State":"管理员状态","Administrators are responsible for creating and managing flavors. A custom flavor can be created for you or for a specific project where it is shared with the users assigned to that project. If you need a custom flavor, contact your administrator.":"管理员负责创建和管理 flavor。可以为您或特定项目创建定制  flavor，在该特定项目中，该 flavor 与分配给该项目的用户共享。如果您需要定制 flavor，请联系您的管理员。","Administrators set up the pool of floating IPs that are available to attach to instances.":"管理员设置可以附加到实例的浮动 IP 的池。","An <b>External</b> network is set up by an administrator.\n    If you want an instance to communicate outside of the data center,\n    then attach a router between your <b>Project</b> network and the <b>External</b> network.\n    You can use the <b>Network Topology</b> view to connect the router to the two networks.":"<b>外部</b>网络由管理员创建。\n如果您希望实例与数据中心的外部网络进行通信，\n那么可以在您的<b>项目</b>网络和<b>外部</b>网络之间添加一个路由器。\n然后可以使用<b>网络拓扑</b>视图来将路由器连接至这两个网络。","An advanced option available when launching an instance is disk partitioning. There are two disk partition options. Selecting <b>Automatic</b> resizes the disk and sets it to a single partition. Selecting <b>Manual</b> allows you to create multiple partitions on the disk.":"当启动实例是磁盘分区时，高级选项可用。有两种磁盘分区选项目。选择<b>自动</b>将调整磁盘并设置为一个单独的分区。选择<b>手动</b>允许您在磁盘上创建多个分区。","An instance name is required and used to help you uniquely identify your instance in the dashboard.":"实例名是必须的，用来帮助您标识仪表盘中的实例。","Another action":"另一操作","Architecture":"架构","Are you sure you want to delete %(name)s?":"确认删除 %(name)s ？","Are you sure you want to delete %(numSelected)s files?":"确认删除 %(numSelected)s 个文件？","Are you sure you want to delete container %(name)s?":"确认删除容器 %(name)s 吗？","Automatic":"自动","Availability Zone":"可用区域","Available":"可用","Block level button":"块级别按钮","Brand":"品牌","Button":"按钮","Buttons":"按钮","Cancel":"取消","Cannot get service catalog from keystone.":"无法从重点获取服务目录。","Cannot get the extension list.":"无法获取扩展列表。","Check the <b>Configuration Drive</b> box if you want to write metadata to a special configuration drive. When the instance boots, it attaches to the <b>Configuration Drive</b> and accesses the metadata.":"如果您想将元数据写入特定的配置驱动中，请选中<b>配置驱动</b>复选框。当实例启动时，它就会附加至<b>配置驱动</b>并访问元数据。","Checksum":"校验和","Click to see more details":"单击以查看更多详细信息","Color":"颜色","Configuration":"配置","Confirm Delete":"确认删除","Confirm Delete Image":["确认删除映像"],"Container":"容器","Container %(name)s created.":"已创建容器 %(name)s。","Container %(name)s deleted.":"已经删除容器 %(name)s。","Container %(name)s is now %(access)s.":"现在，容器 %(name)s 是 %(access)s。","Container Access":"访问容器","Container Format":"容器格式","Container Name":"容器名称","Container name must not contain \"/\".":"容器名称不能包含“/”","Containers":"容器","Content Type":"内容类型","Create":"创建","Create Container":"创建容器","Create Folder":"创建文件夹","Create Folder In: {$ ctrl.model.container.name $}\n    <span>: {$ ctrl.model.folder $}</span>":"创建文件夹： {$ ctrl.model.container.name $}，位于\n    <span>：{$ ctrl.model.folder $}</span>","Create Key Pair":"创建秘钥对","Create Keypair":"创建密钥对","Create New Volume":"创建新卷","Create Volume":"创建卷","Created":"已创建","Created At":"创建时间","Created keypair: ":"已创建密钥对：","Creating":"创建中","Custom Properties":"定制属性","Custom scripts are attached to instances to perform specific actions when the instance is launched. For example, if you are unable to install <samp>cloud-init</samp> inside a guest operating system, you can use a custom script to get a public key and add it to the user account.":"当实例启动时，会将定制脚本附加至实例以执行特定的操作。例如，如果您无法在客户操作系统内安装 <samp>cloud-init</samp>，您可以使用定制脚本来获取一个公钥并将它添加到用户帐户中。","DNS Domain":"DNS 域","DNS Domains":"DNS 域","DNS Record":"DNS 记录","DNS Records":"DNS 记录","Danger":"危险","Data":"数据","Date":"日期","Date Created":"创建时间","Default":"缺省值","Default button":"缺省按钮","Delete":"删除","Delete Container":"删除容器","Delete Image":["删除映像"],"Delete Images":"删除映像","Delete Selection":"删除选中","Delete Volume on Instance Delete":"删除实例删除上的卷","Deleted":"已删除","Deleted Image: %s.":["已删除的映像： %s"],"Deleted.":"已删除。","Deleting":"正在删除","Description":"描述","Description:":"描述：","Details":"详细信息","Device Name":"设备名称","Dialogs":"会话","Direct":"直接","Direction":"方向","Disabled":"禁用","Disk Format":"磁盘格式","Disk Partition":"磁盘分区","Docker":"Docker","Domain ID":"域标识","Down":"下移","Download":"下载","Dropdown":"下拉菜单","Dropdown header":"下拉菜单标题","Dropdown link":"下拉菜单链接","Email":"电子邮件","Enabled":"启用","Encrypted":"已加密","Ephemeral Disk":"临时磁盘","Error":"错误","Error Deleting":"删除时出错","Ether Type":"以太网类型","Example body text":"正文例子","Extension is not enabled: %(extension)s.":"未启用扩展：%(extension)s。","External Network":"外部网络","Failed to delete.":"删除失败。","File":"文件","File %(name)s uploaded.":"文件 %(name)s 已上传。","File Name":"文件名","Filename":"文件名","Fingerprint":"指纹","Flavor":"flavor","Flavor Name":"flavor 名称","Flavors":"方法","Flavors manage the sizing for the compute, memory and storage capacity of the instance.":"flavor 管理实例的计算、内存和存储容量的大小。","Folder":"文件夹","Folder %(name)s created.":"已创建文件夹 %(name)s。","Folder Name":"文件夹名","Format":"映像格式","Forms":"表单","From a Windows system, you can use PuTTYGen to create private/public keys.\n  Use the PuTTY Key Generator to create and save the keys, then copy\n  the public key in the red highlighted box to your <samp>.ssh/authorized_keys</samp>\n  file.":"从 Windows 系统，您可以使用 PuTTYGen 生成私/公密钥。\n使用 PuTTY 密钥生成器来创建和保存这些密钥，\n然后复制红色高亮框中的公钥到您的 \n<samp>.ssh/authorized_keys</samp> 文件。","Hash":"散列","Heading 1":"一级标题","Heading 2":"二级标题","Heading 3":"三级标题","Heading 4":"四级标题","Heading 5":"五级标题","Heading 6":"六级标题","Host ID":"主机标识","ID":"ID","IP":"IP","ISO":"ISO","If \"No volume type\" is selected, the volume will be created without a volume type.":"如果选择“没有卷类型”，那么将创建没有卷类型的卷。","If a network is shared, then all users in the project can access the network.":"如果网络是共享的，那么项目中的所有用户都可以访问网络。","If a security group is not associated with an instance before it is launched, then you will have very limited access to the instance after it is deployed. You will only be able to access the instance from a VNC console.":"如果安全组在启动之前，未与实例进行关联，那么在部署实例后，您将只有非常有限的访问权限。将只能从 VNC 控制台访问实例。","If not, you can manually dowload this keypair at the following link:":"如果没自动下载，您可以手动下载位于以下链接的此密钥对：","If you select an availability zone and plan to use the 'boot from volume' option in the Source step, make sure that the availability zone you select for the instance is the same availability zone where your bootable volume resides.":"如果您选择一个可用域并且计划在“源”步骤中使用“从卷启动”选项，请确保您为实例选择的可用域与您启动卷所在的域相同。","If you want to create an instance that uses ephemeral storage, meaning the instance data is lost when the instance is deleted, then choose one of the following boot sources:":"如果您想创建一个使用临时存储的实例，那么意味着删除实例时实例数据会丢失，然后，从下列引导源中选择一个：","If you want to create an instance that uses persistent storage, meaning the instance data is saved when the instance is deleted, then select one of the following boot options:":"如果要创建一个使用持久存储的实例（意味着删除实例时将保存实例数据），请从以下启动项中选择一个：","Image":"映像","Image Name":"映像名称","Images":"映像","Impact on your quota":"影响您的配额","Import Key Pair":"导入秘钥对","Indicators":"标志","Info":"信息","Instance Snapshot":"实例快照","Instance count is required and must be an integer of at least 1":"实例计数是必须的且必须是至少为 1 的整数","Instance source is the template used to create an instance. You can use a snapshot of an existing instance, an image, or a volume (if enabled).\n      You can also choose to use persistent storage by creating a new volume.":"实例源是用来创建实例的模板。您可以使用现有的实例、映像或卷的快照（如果已启用）。\n您也可以选择通过创建新卷来使用持久的存储器。","Insufficient privilege level to view user information.":"查看用户信息的权限级别不足。","Kernel ID":"内核标识","Key Pair":"密钥对","Key Pair Name\n        <span></span>":"密钥对名称\n        <span></span>","Key Pairs":"密钥对","Key Pairs are how you login to your instance after it is launched.\n      Choose a key pair name you will recognize and paste your SSH public key into the\n      space provided.":"密钥对是您在启动实例后登录实例的一种方式。\n选择一个您易于识别的密钥对名称，并将 SSH 公钥粘贴到\n空白处。","Key Pairs are how you login to your instance after it is launched.\n      Choose a key pair name you will recognize.\n      Names may only include alphanumeric characters, spaces, or dashes.":"密钥对是您在启动实例后登录实例的一种方式。\n选择一个您易于识别的密钥对名称，\n名称只能包含字母字符、空格或减号。","Keypair already exists or name contains bad characters.":"密钥对已经存在或者名称包含不正确的字符。","Killed":"终止","Large button":"大按钮","Launch":"启动","Launch Instance":"启动实例","Left":"左","Library":"库","Link":"链接","Load Balancer Pool":"负载均衡器池","Load Balancer Pool Member":"负载均衡器池成员","Load Balancer Pool Members":"负载均衡器池成员","Load Balancer Pools":"负载均衡器池","Loading":"加载中","MacVTap":"MacVTap","Manual":"手动","Max Port":"最大端口","Members":"成员","Metadata":"元数据","Metadata Definition":"元数据定义","Metadata Definitions":"元数据定义","Middle":"中","Min Disk":"最小磁盘","Min Disk (GB)":"最小磁盘 (GB)","Min Port":"最小端口","Min RAM":"最小内存","Min RAM (MB)":"最小内存 (MB)","Min. Disk":"最小磁盘","Min. RAM":"最小内存","Mini button":"迷你按钮","Name":"名称","Navbar":"导航条","Navs":"导航","Network":"网络","Network Health Monitor":"网络运行状况监控","Network Health Monitors":"网络运行状况监控","Network ID":"网络标识","Network Port":"网络端口","Network Ports":"网络端口","Network Router":"网络路由器","Network Routers":"网络路由器","Network Subnet":"网络子网","Network Subnets":"网络子网","Network characteristics":"网络特性","Networks":"网络","Networks provide the communication channels for instances in the cloud.":"在云中，网络为实例提供通信渠道。","No":"否","No available items":"没有可用项目","Normal":"正常","Note: A Public Container will allow anyone with the Public URL to\n          gain access to your objects in the container.":"注意：公有容器会允许任何人通过公共 URL\n来获取您容器中的对象。","Note: Delimiters ('{$ ctrl.model.DELIMETER $}') are allowed in the\n          file name to place the new file into a folder that will be created\n          when the file is uploaded (to any depth of folders).":"注意：允许在文件名中使用分隔符 ('{$ ctrl.model.DELIMETER $}') \n来将新文件放置到上传该文件（至文件夹的任何深度）时\n创建的文件夹。","Note: Delimiters ('{$ ctrl.model.DELIMETER $}') are allowed in the\n          folder name to create deep folders.":"注意：允许用文件夹名称中的分隔符 ('{$ ctrl.model.DELIMETER $}') \n来创建深层文件夹。","Note: you will not be able to download this later.":"注意：稍后您将无法下载此密钥对。","Number":"数字","OVA":"OVA","Object":"对象","Object Account":"对象帐户","Object Accounts":"对象帐户","Object Container":"对象容器","Object Containers":"对象容器","Object Count":"对象计数","Object Details":"对象详细信息","Objects":"对象","One more separated link":"一个或多个隔离的链接","Other Input Types":"其他输入类型","Overview":"概述","Owner":"所有者","Password":"密码","Pending Delete":"暂挂删除","Physical Network":"物理网络","Please provide the initial hostname for the instance, the availability zone where it will be deployed, and the instance count.\n    Increase the Count to create multiple instances with the same settings.":"请提供实例的初始主机名，将要部署的可用域和实例计数。\n增加计数以创建具有多个同样设置的实例。","Please try again.":"请重试。","Policy check failed.":"策略检查失败。","Ports can be created under a network by administrators.":"可由管理员在网络下创建端口。","Ports provide extra communication channels to your instances. You can select ports instead of networks or a mix of both.":"端口为您的实例提供了额外的通信渠道。您可以选择端口而非网络或者二者都选。","Primary":"主要","Private":"私有","Profile":"概要文件","Progress bars":"进度条","Project":"项目","Project ID":"项目标识","Project networks are created by users.\n    These networks are fully isolated and are project-specific.":"项目网络是由用户创建。\n这些网络完全隔离，为具体项目专用。","Protected":"受保护的","Protocol":"协议","Provider Network":"提供者网络","Provider networks are created by administrators.\n    These networks map to an existing physical network in the data center.":"提供者网络是由管理员创建。\n这些网络映射到数据中心里现有的物理网络。","Public":"公有","Public Access":"公共访问","Public Key":"公钥","Public Key\n        <span></span>":"公钥\n        <span></span>","QCOW2":"QCOW2","Queued":"已排队","RAM":"RAM","RAW":"RAW","RX/TX factor":"RX/TX 因子","Ramdisk ID":"内存盘标识","Re-order items using drag and drop":"使用拖放重新排序","Record Properties":"记录属性","Remote":"远程","Required":"必需","Right":"权限","Root Disk":"根磁盘","Save":"保存","Save changes":"保存变更","Saving":"保存中","Search":"搜索","Security":"安全","Security Groups":"安全组","Security groups are project-specific and cannot be shared across projects.":"安全组是特定项目的，且不能跨项目共享。","Security groups define a set of IP filter rules that determine how network traffic flows to and from an instance. Users can add additional rules to an existing security group to further define the access options for an instance. To create additional rules, go to the <b>Compute | Access & Security</b> view, then find the security group and click <b>Manage Rules</b>.":"安全组定义了 IP 过滤规则的集合，这些规则决定网络流量如何到达和离开实例。为了将来为实例定义访问可选规则，用户可以往现有的安全组添加额外的规则。要创建额外规则，请转至<b>计算 | 访问和安全</b>视图，然后找到安全组，单击<b>管理规则</b>。","Segmentation ID":"分段标识","Select All":"全选","Select Boot Source":"选择引导源","Select a container to browse.":"选择要浏览的容器。","Select a key pair from the available key pairs below.":"从以下可用的密钥对选择一个。","Select a source from those listed below.":"从以下列表选择一个源。","Select a zone":"选择区域","Select an item from Available items below":"从以下可用项中选择一项","Select at least one network":"至少选择一个网络","Select networks from those listed below.":"从下面列示的内容中选择网络。","Select one":"选择一个","Select one or more":"选择一个或多个","Select one or more security groups from the available groups below.":"从以下可用的组中选择一个或多个安全组。","Select ports from those listed below.":"从下面列示的内容中选择端口。","Select the security groups to launch the instance in.":"要在其中启动实例的安全组。","Separated link":"隔离的链接","Server":"服务器","Servers":"服务器","Service type is not enabled: %(desiredType)s":"未启用服务类型：%(desiredType)s","Setting is not enabled: %(setting)s":"未启用配置：%(setting)s","Shared":"共享的","Shared with Me":"与我共享","Size":"大小","Size (GB)":"大小 (GB)","Small button":"小按钮","Snapshot":"快照","Something else here":"此处为其他内容","Source":"源","Source Code":"源代码","Status":"状态","Submit":"提交","Subnets Associated":"子网已关联","Success":"成功","Successfully imported key pair %(name)s.":"成功导入密钥对 %(name)s。","Swap Disk":"Swap 磁盘","Tables":"表格","Tags":"标签","The flavor you select for an instance determines the amount of compute, storage and memory resources that will be carved out for the instance.":"您为实例选择的 flavor 确定计算、存储和内存资源的量，这些资源将会决定实例配置。","The flavor you select must have enough resources allocated to support the type of instance you are trying to create. Flavors that do not provide enough resources for your instance are identified on the <b>Available</b> table with a yellow warning icon.":"您所选择的 flavor 必须分配有足够的资源用来支持您尝试创建的 flavor。未对您的实例提供足够资源的 flavor 在<b>可用</b>表上以黄色警告符号标识。","The following snippet of text is <strong>rendered as bold text</strong>.":"以下文本片段是 <strong>加粗文本</strong>.","The instance count must not exceed your quota available of %(maxInstanceCount)s instances":"实例计数不能超过可用 %(maxInstanceCount)s 实例的配额。","The logical port also defines the MAC address and the IP address(es) to be assigned to the interfaces plugged into them.":"逻辑端口也定义了插入它们的接口将指派的 MAC 地址和 IP 地址（可多个）。","The maximum number of key-value pairs that can be supplied per instance is determined by the compute provider.":"每个实例的健值对的数量上限由其计算服务提供者决定。","The selected %(sourceType)s source requires a flavor with at least %(minDisk)s GB of root disk. Select a flavor with a larger root disk or use a different %(sourceType)s source.":"所选 %(sourceType)s 源需要一个至少 %(minDisk)s GB 根磁盘的 flavor。请选择具有根磁盘的 flavor 或使用另一 %(sourceType)s 源。","The selected %(sourceType)s source requires a flavor with at least %(minRam)s MB of RAM. Select a flavor with more RAM or use a different %(sourceType)s source.":"所选 %(sourceType)s 源需要一个至少 %(minRam)s MB RAM 的 flavor。请选择具有更多 RAM 的 flavor 或使用另一 %(sourceType)s 源。","The status indicates whether the network has an active connection.":"状态表明网络是否具有活动的连接。","The status indicates whether the port has an active connection.":"该状态指示此端口是否具有活动的连接。","The subnet identifies a sub-section of a network. A subnet is specified in CIDR format.\n    A typical CIDR format looks like <samp>192.xxx.x.x/24</samp>.":"该子网标识了一个网段。子网的指定格式为 CIDR。\n典型的 CIDR 格式类似 <samp>192.xxx.x.x/24</samp>。","The volume size must be at least %(minVolumeSize)s GB":"卷大小必须至少为 %(minVolumeSize)s GB","There are two ways to generate a key pair. From a Linux system,\n  generate the key pair with the <samp>ssh-keygen</samp> command:":"有两种方式生成密钥对。从一个 Linux 系统，\n使用 <samp>ssh-keygen</samp> 命令生成密钥对。","This command generates a pair of keys: a private key (cloud.key)\n  and a public key (cloud.key.pub).":"此命令生成一对密钥：一个私钥 (cloud.key) \n和一个公钥 (cloud.key.pub)。","This flavor requires more RAM than your quota allows. Please select a smaller flavor or decrease the instance count.":"此 flavor 需要的 RAM 超过配额允许。请选择更小的 flavor 或减少实例数。","This flavor requires more VCPUs than your quota allows. Please select a smaller flavor or decrease the instance count.":"此 flavor 需要的 VCPU 超过配额允许。请选择更小的 flavor 或减少实例数。","This limit is currently not set.":"当前未设置此限制。","This limit is currently set to {$ model.novaLimits.maxServerMeta $}.":"此设置当前设置为 {$ model.novaLimits.maxServerMeta $} 。","This step allows you to add Metadata items to your instance.":"此步骤允许您为实例添加元数据条目。","Time":"时间","Timestamp":"时间戳记","To view source code, hover over a section, then click the <a><span></span></a> button in the top right of that section.":"要查看源代码，请使光标悬浮在某节上，然后单击该节右上角的 <a><span></span></a> 按钮。","Total Disk":"磁盘总计","Total Instances":"实例总计","Total RAM":"RAM 总计","Total VCPUs":"VCPU 总计","Type":"类型","Type your script directly into the Customization Script field. If your browser supports the HTML5 File API, you may choose to load your script from a file. The size of your script should not exceed 16 Kb.":"直接在“定制脚本”字段中输入您的脚本。如果您的浏览器支持 HTML5 文件 API，那么可以选择从文件加载您的脚本。您的脚本大小不能超过 16Kb。","Unable to allocate new floating IP address.":"无法分配新浮动 IP 地址。","Unable to associate floating IP address.":"无法关联浮动 IP 地址。","Unable to change the container access.":"无法更改容器访问权。","Unable to copy the object.":"无法复制对象。","Unable to create the container.":"无法创建容器。","Unable to create the domain.":"无法创建域。","Unable to create the flavor.":"无法创建方法。","Unable to create the folder.":"无法创建文件夹。","Unable to create the image.":"无法创建映像。","Unable to create the keypair.":"无法创建密钥对。","Unable to create the network.":"无法创建网络。","Unable to create the project.":"无法创建项目。","Unable to create the role.":"无法创建角色。","Unable to create the server.":"无法创建服务器。","Unable to create the subnet.":"无法创建子网。","Unable to create the user.":"无法创建用户。","Unable to create the volume.":"无法创建卷。","Unable to delete Image: %s.":["无法删除映像： %s 。"],"Unable to delete the container.":"无法删除容器。","Unable to delete the domain.":"无法删除域。","Unable to delete the domains.":"无法删除域。","Unable to delete the flavor with id: %(id)s":"无法删除标识为 %(id)s 的方法","Unable to delete the folder because it is not empty.":"无法删除文件夹，因为它非空。","Unable to delete the image with id: %(id)s":"无法删除标识为 %(id)s 的映像","Unable to delete the object.":"无法删除对象。","Unable to delete the project.":"无法删除项目。","Unable to delete the projects.":"无法删除项目。","Unable to delete the role.":"无法删除角色。","Unable to delete the roles.":"无法删除角色。","Unable to delete the user.":"无法删除用户。","Unable to delete the users.":"无法删除用户。","Unable to disassociate floating IP address.":"无法解除关联浮动 IP 地址。","Unable to edit instance metadata.":"无法编辑实例元数据。","Unable to edit the aggregate extra specs.":"无法编辑聚集 extra spec。","Unable to edit the domain.":"无法编辑域。","Unable to edit the flavor extra specs.":"无法编辑方法 extra spec。","Unable to edit the image custom properties.":"无法编辑映像的定制属性。","Unable to edit the project.":"无法编辑项目。","Unable to edit the role.":"无法编辑角色。","Unable to edit the user.":"无法编辑用户。","Unable to fetch the service catalog.":"无法取得服务目录。","Unable to fetch the services.":"无法获取服务。","Unable to generate":"无法生成","Unable to get details of the object.":"无法获取对象的详细信息。","Unable to get the Glance service version.":"无法获取 Glance 服务版本。","Unable to get the Keystone service version.":"无法获取 Keystone 服务版本","Unable to get the Swift container listing.":"无法获取 Swift 容器列表。","Unable to get the Swift service info.":"无法获取 Swift 服务信息。","Unable to get the container details.":"无法获取容器详细信息。","Unable to get the objects in container.":"无法获取容器中的对象。","Unable to grant the role.":"无法授权于角色","Unable to import the keypair.":"无法导入密钥对。","Unable to retrieve floating IP pools.":"无法检索浮动 IP 池。","Unable to retrieve floating IPs.":"无法检索浮动 IP。","Unable to retrieve instance metadata.":"无法检索实例元数据。","Unable to retrieve instances.":"无法检索实例。","Unable to retrieve settings.":"无法检索设置。","Unable to retrieve the Absolute Limits.":"无法检索绝对限制。","Unable to retrieve the QoS Specs.":"无法检索 QoS 规格。","Unable to retrieve the agents.":"无法检索代理程序。","Unable to retrieve the aggregate extra specs.":"无法检索聚集 extra spec。","Unable to retrieve the availability zones.":"无法检索可用区域。","Unable to retrieve the cinder services.":"无法检索 cinder 服务。","Unable to retrieve the current user session.":"无法检索当前用户会话。","Unable to retrieve the default volume type.":"无法检索缺省卷类型。","Unable to retrieve the domain.":"无法检索域。","Unable to retrieve the domains.":"无法检索域。","Unable to retrieve the extensions.":"无法检索扩展。","Unable to retrieve the flavor extra specs.":"无法检索方法 extra spec。","Unable to retrieve the flavor.":"无法检索方法。","Unable to retrieve the flavors.":"无法检索方法。","Unable to retrieve the heat services.":"无法检索 heat 服务。","Unable to retrieve the image custom properties.":"无法检索映像的定制属性。","Unable to retrieve the image.":"无法检索映像。","Unable to retrieve the images.":"无法检索映像。","Unable to retrieve the keypairs.":"无法检索密钥对。","Unable to retrieve the limits.":"无法检索限制。","Unable to retrieve the namespaces.":"无法检索名称空间。","Unable to retrieve the networks.":"无法检索网络。","Unable to retrieve the nova services.":"无法检索 nova 服务。","Unable to retrieve the ports.":"无法检索端口。","Unable to retrieve the project.":"无法检索项目。","Unable to retrieve the projects.":"无法检索项目。","Unable to retrieve the resource types.":"无法检索资源类型。","Unable to retrieve the role.":"无法检索角色。","Unable to retrieve the roles.":"无法检索角色。","Unable to retrieve the security groups.":"无法检索安全组。","Unable to retrieve the server.":"无法检索服务器。","Unable to retrieve the subnets.":"无法检索子网。","Unable to retrieve the user.":"无法检索用户。","Unable to retrieve the users.":"无法检索用户。","Unable to retrieve the volume snapshots.":"无法检索卷快照。","Unable to retrieve the volume type.":"无法检索卷类型。","Unable to retrieve the volume types.":"无法检索卷类型。","Unable to retrieve the volume.":"无法检索卷。","Unable to retrieve the volumes.":"无法检索卷。","Unable to update the flavor.":"无法更新方法。","Unable to update the image.":"无法删除映像。","Unable to upload the object.":"无法上传对象。","Unable to validate the template.":"无法验证模板。","Unknown":"未知","Up":"上移","Update Aggregate Metadata":"更新聚集元数据","Update Flavor Metadata":"更新方法元数据","Update Image Metadata":"更新映像元数据","Update Instance Metadata":"更新实例元数据","Update Metadata":"更新元数据","Updated":"已更新","Updated At":"更新时间","Upload File":"上传文件","Upload File To: {$ ctrl.model.container.name $}\n    <span>: {$ ctrl.model.folder $}</span>":"上传文件到：{$ ctrl.model.container.name $}\n    <span>：{$ ctrl.model.folder $}</span>","Uploading":"上传中","Url":"URL","Use image as a source":"使用映像作为源","User ID":"用户标识","User Name":"用户名","VCPUS":"VCPU 数","VCPUs":"VCPU","VDI":"VDI","VHD":"VHD","VMDK":"VMDK","VNIC type":"VNIC 类型","View Details":"查看详细信息","Virtual Size":"虚拟大小","Virtual instances attach their interfaces to ports.":"虚拟实例将其借口连接至端口。","Visibility":"可见","Volume":"卷","Volume %s was successfully created.":"成功创建了卷 %s。","Volume Backup":"卷备份","Volume Backups":"卷备份","Volume Details":"卷详细信息","Volume Quota":"卷配额","Volume Size (GB)\n              <span></span>":"卷大小 (GB)\n              <span></span>","Volume Snapshot":"卷快照","Volume Snapshots":"卷快照","Volume Type Description:":"卷类型描述：","Volume and Snapshot Quota (GB)":"卷和快照配额 (GB)","Volume size is required and must be an integer":"卷大小是必须的而且必须为整数","Volumes":"卷","Volumes are block devices that can be attached to instances.":"卷是可以附加到实例的块设备。","Volumes can only be attached to 1 active instance at a time. Please either set your instance count to 1 or select a different source type.":"同一时刻，卷只能附加到一个活动的实例。请设置您的实例计数为 1 或者选择一个不同的源类型。","Warning":"警告","Warning!":"警告！","Week":"星期","When IP addresses are associated to a port, this also implies the port is associated with a subnet, as the IP address was taken from the allocation pool for a specific subnet.":"当 IP 地址与端口关联时，这暗示了该端口也与某个子网关联，因为 IP 地址是从特定子网的分配池中获取的。","When selecting volume as boot source, please ensure the instance's availability zone is compatible with your volume's availability zone.":"当选择卷为引导源时，请确保实例的可用域与您的卷可用域兼容。","When the <b>Admin State</b> for a network is set to <b>Up</b>,\n    then the network is available for use. You can set the <b>Admin State</b> to <b>Down</b>\n    if you are not ready for other users to access the network.":"当网络的 <b>Admin State</b> 设置为<b>Up</b>,\n那么网络是可用的。如果您还没有准备让其他用户访问该网络，\n那么可以把 <b>Admin State</b> 设置为<b>Down</b>。","When the <b>Admin State</b> for a port is set to <b>Up</b> and it has no <b>Device Owner</b>,\n    then the port is available for use. You can set the <b>Admin State</b> to <b>Down</b>\n    if you are not ready for other users to use the port.":"当端口的<b>管理状态</b>设置为<b>开启</b>且没有<b>设备所有者</b>时，\n    那么此端口可供使用。\n如果该接口尚未准备就绪供其他用户使用，那么可以将<b>管理状态</b>设为<b>关闭</b>。","Yes":"是","You are not allowed to delete images: %s":"不允许删除映像： %s","You can add arbitrary metadata to your instance so that you can more easily identify it among other running instances. Metadata is a collection of key-value pairs associated with an instance. The maximum length for each metadata key and value is 255 characters.":"您可以为您的实例添加任何元数据，以便更容易地区别于其他正在运行的实例。元数据是与实例相关联的键值对的集合。每个实例的键或值的长度不能超过 255 个字节。","You can customize your instance after it has launched using the options available here.\n    \"Customization Script\" is analogous to \"User Data\" in other systems.":"使用此处可用的选项启动实例后，您就可以定制该实例。\n“定制脚本”与其他系统中的“用户数据”类似。","You have selected \"%s\". Deleted image is not recoverable.":["您选择了“%s”。删除的映像均无法恢复。"],"disabled":"已禁用","error":["错误"],"image":"映像","link":"链接","message":["消息"],"snapshot":"快照","submit":["提交"],"success":["成功"],"title":["标题"],"{$ row['provider:network_type'] $}":"{$ row['provider:network_type'] $}"};
  var value = catalog[msgid];
  if (typeof(value) == 'undefined') {
    return msgid;
  } else {
    return (typeof(value) == 'string') ? value : value[0];
  }
}

window.topology = {
  model: null,
  fa_globe_glyph: '\uf0ac',
  fa_globe_glyph_width: 15,
  svg:'#topology_canvas',
  svg_container:'#flatTopologyCanvasContainer',
  network_tmpl:{
    small:'#topology_template > .network_container_small',
    normal:'#topology_template > .network_container_normal'
  },
  router_tmpl: {
    small:'#topology_template > .router_small',
    normal:'#topology_template > .router_normal'
  },
  instance_tmpl: {
    small:'#topology_template > .instance_small',
    normal:'#topology_template > .instance_normal'
  },
  balloon_tmpl : null,
  balloon_device_tmpl : null,
  balloon_port_tmpl : null,
  network_index: {},
  balloon_id:null,
  reload_duration: 10000,
  draw_mode:'normal',
  network_height : 0,
  previous_message : null,
  element_properties:{
    normal:{
      network_width:270,
      network_min_height:500,
      top_margin:80,
      default_height:50,
      margin:20,
      device_x:98.5,
      device_width:90,
      port_margin:16,
      port_height:6,
      port_width:82,
      port_text_margin:{x:6,y:-4},
      texts_bg_y:32,
      type_y:46,
      balloon_margin:{x:12,y:-12}
    },
    small :{
      network_width:100,
      network_min_height:400,
      top_margin:50,
      default_height:20,
      margin:30,
      device_x:47.5,
      device_width:20,
      port_margin:5,
      port_height:3,
      port_width:32.5,
      port_text_margin:{x:0,y:0},
      texts_bg_y:0,
      type_y:0,
      balloon_margin:{x:12,y:-30}
    },
    cidr_margin:5,
    device_name_max_size:9,
    device_name_suffix:'..'
  },
  select_port: function(device_id){
    return $.map(this.model.ports,function(port){
      if (port.device_id === device_id) {
        return port;
      }
    });
  },
  select_main_port: function(ports){
    var _self = this;
    var main_port_index = 0;
    var MAX_INT = 4294967295;
    var min_port_length = MAX_INT;
    $.each(ports, function(index, port){
      var port_length = _self.sum_port_length(port.network_id, ports);
      if(port_length < min_port_length){
        min_port_length = port_length;
        main_port_index = index;
      }
    });
    return ports[main_port_index];
  },
  sum_port_length: function(network_id, ports){
    var self = this;
    var sum_port_length = 0;
    var base_index = self.get_network_index(network_id);
    $.each(ports, function(index, port){
      sum_port_length += base_index - self.get_network_index(port.network_id);
    });
    return sum_port_length;
  },
  get_network_index: function(network_id) {
    return this.network_index[network_id];
  },
  get_network_color: function(network_id) {
    return this.color(this.get_network_index(network_id));
  },
  string_truncate: function(string) {
    var self = this;
    var str = string;
    var max_size = self.element_properties.device_name_max_size;
    var suffix = self.element_properties.device_name_suffix;
    var bytes = 0;
    for (var i = 0; i < str.length; i++) {
      bytes += str.charCodeAt(i) <= 255 ? 1 : 2;
      if (bytes > max_size) {
        str = str.substr(0, i) + suffix;
        break;
      }
    }
    return str;
  },
  convertData: function () {
    var self = this;
    self.model = model;
    self.$container = $(self.svg_container);
    self.color = d3.scale.category10();
    self.balloon_tmpl = Hogan.compile($('#balloon_container').html());
    self.balloon_device_tmpl = Hogan.compile($('#balloon_device').html());
    self.balloon_port_tmpl = Hogan.compile($('#balloon_port').html());
    $(document).on('click', 'a.closeTopologyBalloon', function(e) {
      e.preventDefault();
      self.delete_balloon();
    })


    $.each(model.networks, function(index, network) {
      self.network_index[network.id] = index;
    });
    //self.select_draw_mode();
    var element_properties = self.element_properties[self.draw_mode];
    self.network_height = element_properties.top_margin;
    $.each([
      {model:model.routers, type:'router'},
      {model:model.servers, type:'instance'}
    ], function(index, devices) {
      var type = devices.type;
      var model = devices.model;
      $.each(model, function(index, device) {
        device.type = type;
        device.ports = self.select_port(device.id);
        var hasports = device.ports.length > 0;
        device.parent_network = (hasports) ? self.select_main_port(device.ports).network_id : self.model.networks[0].id;
        var height = element_properties.port_margin*(device.ports.length - 1);
        device.height = (self.draw_mode === 'normal' && height > element_properties.default_height) ? height : element_properties.default_height;
        device.pos_y = self.network_height;
        device.port_height = (self.draw_mode === 'small' && height > device.height) ? 1 : element_properties.port_height;
        device.port_margin = (self.draw_mode === 'small' && height > device.height) ? device.height/device.ports.length : element_properties.port_margin;
        self.network_height += device.height + element_properties.margin;
      });
    });
    $.each(model.networks, function(index, network) {
      network.devices = [];
      $.each([model.routers, model.servers],function(index, devices) {
        $.each(devices,function(index, device) {
          if(network.id === device.parent_network) {
            network.devices.push(device);
          }
        });
      });
    });
    self.network_height += element_properties.top_margin;
    self.network_height = (self.network_height > element_properties.network_min_height) ? self.network_height : element_properties.network_min_height;

    self.draw_topology();
  },

  draw_topology:function() {
    var self = this;
    $(self.svg_container).removeClass('noinfo');
    if (self.model.networks.length <= 0) {
      $('g.network').remove();
      $(self.svg_container).addClass('noinfo');
      return;
    }
    var svg = d3.select(self.svg);
    var element_properties = self.element_properties[self.draw_mode];
    svg
      .attr('width',self.model.networks.length*element_properties.network_width)
      .attr('height',self.network_height);

    var network = svg.selectAll('g.network')
      .data(self.model.networks);

    network.enter()
      .append('g')
      .attr('class','network')
      .each(function(d){
        this.appendChild(d3.select(self.network_tmpl[self.draw_mode]).node().cloneNode(true));
        var $this = d3.select(this).select('.network-rect');
        if (d.url) {
          $this
            .on('mouseover',function(){
              $this.transition().style('fill', function() {
                return d3.rgb(self.get_network_color(d.id)).brighter(0.5);
              });
            })
            .on('mouseout',function(){
              $this.transition().style('fill', function() {
                return self.get_network_color(d.id);
              });
            })
            .on('click',function(){
              window.location.href = d.url;
            });
        } else {
          $this.classed('nourl', true);
        }
      });

    network
      .attr('id',function(d) { return 'id_' + d.id; })
      .attr('transform',function(d,i){
        return 'translate(' + element_properties.network_width * i + ',' + 0 + ')';
      })
      .select('.network-rect')
      .attr('height', function() { return self.network_height; })
      .style('fill', function(d) { return self.get_network_color(d.id); });
    network
      .select('.network-name')
      .attr('x', function() { return self.network_height/2; })
      .text(function(d) { return d.name; });
    network
      .select('.network-cidr')
      .attr('x', function(d) {
        var padding = isExternalNetwork(d) ? self.fa_globe_glyph_width : 0;
        return self.network_height - self.element_properties.cidr_margin -
          padding;
      })
      .text(function(d) {
        var cidr = $.map(d.subnets,function(n){
          return n.cidr;
        });
        return cidr.join(', ');
      });
    function isExternalNetwork(d) {
      return d['router:external'];
    }

    network
      .select('.network-type')
      .text(function(d) {
        return isExternalNetwork(d) ? self.fa_globe_glyph : '';
      })
      .attr('x', function() {
        return self.network_height - self.element_properties.cidr_margin;
      });

    //$('[data-toggle="tooltip"]').tooltip({container: 'body'});

    network.exit().remove();

    var device = network.selectAll('g.device')
      .data(function(d) { return d.devices; });

    var device_enter = device.enter()
      .append("g")
      .attr('class','device')
      .each(function(d){
        var device_template = self[d.type + '_tmpl'][self.draw_mode];
        this.appendChild(d3.select(device_template).node().cloneNode(true));
      });

    device_enter
      .on('mouseenter',function(d){
        var $this = $(this);
        self.show_balloon(d,$this);
      })
      .on('click',function(){
        d3.event.stopPropagation();
      });

    device
      .attr('id',function(d) { return 'id_' + d.id; })
      .attr('transform',function(d){
        return 'translate(' + element_properties.device_x + ',' + d.pos_y + ')';
      })
      .select('.frame')
      .attr('height',function(d) { return d.height; });
    device
      .select('.texts_bg')
      .attr('y',function(d) {
        return element_properties.texts_bg_y + d.height - element_properties.default_height;
      });
    device
      .select('.type')
      .attr('y',function(d) {
        return element_properties.type_y + d.height - element_properties.default_height;
      });
    device
      .select('.name')
      .text(function(d) { return self.string_truncate(d.name); });
    device.each(function(d) {
      if (d.status === 'BUILD') {
        d3.select(this).classed('loading',true);
      } else if (d.task === 'deleting') {
        d3.select(this).classed('loading',true);
        if ('bl_' + d.id === self.balloon_id) {
          self.delete_balloon();
        }
      } else {
        d3.select(this).classed('loading',false);
        if ('bl_' + d.id === self.balloon_id) {
          var $this = $(this);
          self.show_balloon(d,$this);
        }
      }
    });

    device.exit().each(function(d){
      if ('bl_' + d.id === self.balloon_id) {
        self.delete_balloon();
      }
    }).remove();

    var port = device.select('g.ports')
      .selectAll('g.port')
      .data(function(d) { return d.ports; });

    var port_enter = port.enter()
      .append('g')
      .attr('class','port')
      .attr('id',function(d) { return 'id_' + d.id; });

    port_enter
      .append('line')
      .attr('class','port_line');

    port_enter
      .append('text')
      .attr('class','port_text');

    device.select('g.ports').each(function(d){
      this._portdata = {};
      this._portdata.ports_length = d.ports.length;
      this._portdata.parent_network = d.parent_network;
      this._portdata.device_height = d.height;
      this._portdata.port_height = d.port_height;
      this._portdata.port_margin = d.port_margin;
      this._portdata.left = 0;
      this._portdata.right = 0;
      $(this).mouseenter(function(e){
        e.stopPropagation();
      });
    });

    port.each(function(d){
      var index_diff = self.get_network_index(this.parentNode._portdata.parent_network) -
        self.get_network_index(d.network_id);
      this._index_diff = index_diff = (index_diff >= 0)? ++index_diff : index_diff;
      this._direction = (this._index_diff < 0)? 'right' : 'left';
      this._index = this.parentNode._portdata[this._direction] ++;

    });

    port.attr('transform',function(){
      var x = (this._direction === 'left') ? 0 : element_properties.device_width;
      var ports_length = this.parentNode._portdata[this._direction];
      var distance = this.parentNode._portdata.port_margin;
      var y = (this.parentNode._portdata.device_height -
        (ports_length -1)*distance)/2 + this._index*distance;
      return 'translate(' + x + ',' + y + ')';
    });

    port
      .select('.port_line')
      .attr('stroke-width',function() {
        return this.parentNode.parentNode._portdata.port_height;
      })
      .attr('stroke', function(d) {
        return self.get_network_color(d.network_id);
      })
      .attr('x1',0).attr('y1',0).attr('y2',0)
      .attr('x2',function() {
        var parent = this.parentNode;
        var width = (Math.abs(parent._index_diff) - 1)*element_properties.network_width +
          element_properties.port_width;
        return (parent._direction === 'left') ? -1*width : width;
      });

    port
      .select('.port_text')
      .attr('x',function() {
        var parent = this.parentNode;
        if (parent._direction === 'left') {
          d3.select(this).classed('left',true);
          return element_properties.port_text_margin.x*-1;
        } else {
          d3.select(this).classed('left',false);
          return element_properties.port_text_margin.x;
        }
      })
      .attr('y',function() {
        return element_properties.port_text_margin.y;
      })
      .text(function(d) {
        var ip_label = [];
        $.each(d.fixed_ips, function() {
          ip_label.push(this.ip_address);
        });
        return ip_label.join(',');
      });

    port.exit().remove();
  },

  show_balloon:function(d,element) {
    var self = this;
    var element_properties = self.element_properties[self.draw_mode];
    if (self.balloon_id) {
      self.delete_balloon();
    }
    var balloon_tmpl = self.balloon_tmpl;
    var device_tmpl = self.balloon_device_tmpl;
    var port_tmpl = self.balloon_port_tmpl;
    var balloon_id = 'bl_' + d.id;
    var ports = [];
    $.each(d.ports,function(i, port){
      var object = {};
      object.id = port.id;
      object.router_id = port.device_id;
      object.url = port.url;
      object.port_status = port.status;
      object.port_status_css = (port.status === "ACTIVE")? 'active' : 'down';
      var ip_address = '';
      try {
        ip_address = port.fixed_ips[0].ip_address;
      }catch(e){
        ip_address = gettext('None');
      }
      var device_owner = '';
      try {
        device_owner = port.device_owner.replace('network:','');
      }catch(e){
        device_owner = gettext('None');
      }
      var network_id = '';
      try {
        network_id = port.network_id;
      }catch(e) {
        network_id = gettext('None');
      }
      object.network_id = network_id;
      object.ip_address = ip_address;
      object.device_owner = device_owner;
      object.is_interface = (device_owner === 'router_interface' || device_owner === 'router_gateway');
      ports.push(object);
    });
    var html;
    var html_data = {
      balloon_id:balloon_id,
      id:d.id,
      url:d.url,
      name:d.name,
      type:d.type,
      delete_label: gettext("Delete"),
      status:d.status,
      status_class:(d.status === "ACTIVE")? 'active' : 'down',
      status_label: gettext("STATUS"),
      id_label: gettext("ID"),
      interfaces_label: gettext("Interfaces"),
      delete_interface_label: gettext("Delete Interface"),
      open_console_label: gettext("Open Console"),
      view_details_label: gettext("View Details")
    };
    if (d.type === 'router') {
      html_data.delete_label = gettext("Delete Router");
      html_data.view_details_label = gettext("View Router Details");
      html_data.port = ports;
      html_data.add_interface_url = d.url + 'addinterface';
      html_data.add_interface_label = gettext("Add Interface");
      html = balloon_tmpl.render(html_data,{
        table1:device_tmpl,
        table2:(ports.length > 0) ? port_tmpl : null
      });
    } else if (d.type === 'instance') {
      html_data.delete_label = gettext("Delete Instance");
      html_data.view_details_label = gettext("View Instance Details");
      html_data.console_id = d.id;
      html_data.console = d.console;
      html = balloon_tmpl.render(html_data,{
        table1:device_tmpl
      });
    } else {
      return;
    }
    $(self.svg_container).append(html);
    var device_position = element.find('.frame');
    var sidebar_width = $("#sidebar").width();
    var navbar_height = $(".navbar").height();
    var breadcrumb_height = $(".breadcrumb").outerHeight(true);
    var pageheader_height = $(".page-header").outerHeight(true);
    var launchbuttons_height = $(".launchButtons").height();
    var height_offset = navbar_height + breadcrumb_height + pageheader_height + launchbuttons_height;
    var device_offset = device_position.offset();
    var x = Math.round(device_offset.left + element_properties.device_width + element_properties.balloon_margin.x - sidebar_width);
    // 15 is magic pixel value that seems to make things line up
    var y = Math.round(device_offset.top + element_properties.balloon_margin.y - height_offset + 15);
    var $balloon = $('#' + balloon_id);
    $balloon.css({
      'left': '0px',
      'top': y + 'px'
    });
    var balloon_width = $balloon.outerWidth();
    var left_x = device_offset.left - balloon_width - element_properties.balloon_margin.x - sidebar_width;
    var right_x = x + balloon_width + element_properties.balloon_margin.x + sidebar_width;

    if (left_x > 0 && right_x > $(window).outerWidth()) {
      x = left_x;
      $balloon.addClass('leftPosition');
    }
    $balloon.css({
      'left': x + 'px'
    }).show();

    $balloon.find('.delete-device').click(function(){
      var $this = $(this);
      var delete_modal = horizon.datatables.confirm($this);
      delete_modal.find('.btn-primary').click(function () {
        $this.prop('disabled', true);
        d3.select('#id_' + $this.data('device-id')).classed('loading',true);
        self.delete_device($this.data('type'),$this.data('device-id'));
        horizon.modals.spinner.modal('hide');
      });
    });
    $balloon.find('.delete-port').click(function(){
      var $this = $(this);
      var delete_modal = horizon.datatables.confirm($this);
      delete_modal.find('.btn-primary').click(function () {
        $this.prop('disabled', true);
        self.delete_port($this.data('router-id'),$this.data('port-id'),$this.data('network-id'));
        horizon.modals.spinner.modal('hide');
      });
    });
    self.balloon_id = balloon_id;
  },
  delete_balloon:function() {
    var self = this;
    if(self.balloon_id) {
      $('#' + self.balloon_id).remove();
      self.balloon_id = null;
    }
  }
}

topology.convertData();
console.log(model)