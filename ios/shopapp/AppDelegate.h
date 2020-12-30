#import <React/RCTBridgeDelegate.h>
#import <UIKit/UIKit.h>
#import <RCTJPushModule.h>

@interface AppDelegate : UIResponder <UIApplicationDelegate, RCTBridgeDelegate,JPUSHGeofenceDelegate,JPUSHRegisterDelegate>

@property (nonatomic, strong) UIWindow *window;

@end
